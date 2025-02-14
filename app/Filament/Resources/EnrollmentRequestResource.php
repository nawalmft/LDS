<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentRequestResource\Pages;
use App\Filament\Resources\EnrollmentRequestResource\RelationManagers;
use App\Models\EnrollmentRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Set;
use Filament\Forms\Get;

class EnrollmentRequestResource extends Resource
{
    protected static ?string $model = EnrollmentRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'التسجيلات ';
    protected static ?string $pluralLabel = 'طلبات التسجيل';
    protected static ?string $modellabel = 'طلب التسجيل';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->required()
                    ->label(' الدورة')

                    ->options(function () {
                        return \App\Models\Course::all()->pluck('title', 'id');
                    })
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        self::calculateTotalPrice($get, $set);
                    }),
                    
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->label(' المدرب')
                    ->options(function () {
                        return \App\Models\User::Where('role', 'student')->pluck('name', 'id');
                    }),

                    Forms\Components\Select::make('trainee.name')
                    ->required()
                       // ->disabled()
                    ->options(function () {
                        return \App\Models\Trainee::all()->pluck('name', 'id');
                    })
                    ->label(' المتدرب'),
                 
                    
                Forms\Components\DatePicker::make('preferred_starting_date')
                    ->required()
                    ->label('تاريخ البدء المفضل'),

                Forms\Components\Select::make('preferred_payment_method')
                    ->required()
                    ->label('طريقة الدفع المفضلة')
                    ->options([
                        'per-lesson' => 'لكل درس',
                        'pre-pay' => 'مدفوعة مسبقا',
                    ]),


                    Forms\Components\TextInput::make('preferred_daily_hours')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->label(' عدد الساعات اليومية المفضلة'),

                Forms\Components\TimePicker::make('preferred_time')
                    ->required()
                    ->label('وقت البدء المفضل'),
                    
                    Forms\Components\TextInput::make('preferred_total_hours')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        self::calculateTotalPrice($get, $set);
                    })
                    ->minValue(4)
                    ->label(' عدد الساعات الكلية المفضلة'),

                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'قيد الانتظار' => 'قيد الانتظار',
                        // 'تم القبول مبدائيا و في انتظاء الدفع' => 'تم القبول مبدائيا و في انتظاء الدفع',
                        'مقبول' => 'مقبول',
                        'مرفوض' => 'مرفوض',
                    ])
                    ->default('active')
                    ->required(),

                    Forms\Components\TextInput::make('total_price')
                    ->label('السعر الكلي')
                    //  ->disabled()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.title')
                    ->numeric()
                    ->label(' الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label(' المدرب')
                    ->sortable(),
                Tables\Columns\TextColumn::make('trainee.name')
                    ->label(' المتدرب')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('preferred_starting_date')
                //     ->date()
                //     ->label('تاريخ البدء المفضل')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('preferred_payment_method')
                    ->label('طريقة الدفع المفضلة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('preferred_daily_hours')
                    ->label('عدد الساعات اليومية المفضلة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('preferred_total_hours')
                    ->label('عدد الساعات الكلية المفضلة')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('preferred_time')
                //     ->label('الوقت المفضل')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('السعر الكلي')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('printInvoice')
                ->label('طباعة الفاتورة')
                ->icon('heroicon-o-printer')
                ->action(function (EnrollmentRequest $record) {
                    return response()->streamDownload(
                        function () use ($record) {
                            echo PDF::loadView('enrollment.invoice', [
                                'record' => $record->load(['user', 'course'])
                            ])->stream();
                        },
                        "invoice-{$record->id}.pdf"
                    );
                }), 
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnrollmentRequests::route('/'),
            'create' => Pages\CreateEnrollmentRequest::route('/create'),
            'edit' => Pages\EditEnrollmentRequest::route('/{record}/edit'),
        ];
    }


    public static function getHourPriceFromCourse(Get $get)
    {
        
        $course = \App\Models\Course::find($get('course_id'));
        
        return [
            'hour_price' => $course->hour_price,
            'course_fee' => $course->fee,];
    }
    public static function calculateTotalPrice(Get $get , Set $set)
    {
        $set('total_price',  $get('preferred_total_hours') * self::getHourPriceFromCourse($get)['hour_price'] + self::getHourPriceFromCourse($get)['course_fee']);
    }
}
