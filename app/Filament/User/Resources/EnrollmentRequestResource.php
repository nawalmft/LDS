<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\EnrollmentRequestResource\Pages;
use App\Filament\User\Resources\EnrollmentRequestResource\RelationManagers;
use App\Models\EnrollmentRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnrollmentRequestResource extends Resource
{
    protected static ?string $model = EnrollmentRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'التسجيلات';
    protected static ?string $pluralLabel = 'طلبات التسجيل';
    protected static ?string $modellabel = 'طلب التسجيل';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('course_id')
                    ->required()
                    ->label('الدورة')
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->label('المستخدم')
                    ->numeric(),
                Forms\Components\DatePicker::make('preferred_starting_date')
                    ->label('تاريخ البدء المفضل')
                    ->required(),
                Forms\Components\TextInput::make('preferred_payment_method')
                    ->label('طريقة الدفع المفضلة')
                    ->required(),
                Forms\Components\TextInput::make('preferred_time')
                    ->label('وقت البدء المفضل')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->label('الحالة')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.title')
                    ->numeric()
                    ->label('الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label('المستخدم')
                    ->sortable(),
                Tables\Columns\TextColumn::make('preferred_starting_date')
                    ->date()
                    ->label('تاريخ البدء المفضل')
                    ->sortable(),
                Tables\Columns\TextColumn::make('preferred_payment_method')
                    ->label('طريقة الدفع المفضلة'),
                Tables\Columns\TextColumn::make('preferred_time')
                    ->label('وقت البدء المفضل'),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    # 
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id',auth()->id());
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
}
