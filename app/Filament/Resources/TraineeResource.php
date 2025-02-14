<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TraineeResource\Pages;
use App\Filament\Resources\TraineeResource\RelationManagers;
use App\Models\Trainee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class TraineeResource extends Resource
{
    protected static ?string $model = Trainee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'المتدربين';
    protected static ?string $pluralLabel = 'المتدربين';
    protected static ?string $modelLabel = 'المتدرب';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required('الرجاء ادخال الاسم')
                    ->label('الاسم')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email('الرجاء ادخال بريد الكتروني صالح')
                    ->label('البريد الالكتروني')
                    ->unique(ignoreRecord: true)
                    ->required('الرجاء ادخال بريد الكتروني ')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->tel()
                    ->unique(ignoreRecord: true)
                    ->startsWith('91,92,93,94,95')
                    ->maxLength(9)
                    ->required('الرجاء ادخال رقم الهاتف'),
                   
                 
                Forms\Components\FileUpload::make('image')
                    ->label('الصورة')
                    ->directory('trainees')
                    ->image(),
                    
                Forms\Components\DatePicker::make('date_of_birth')
                    ->label('تاريخ الميلاد')
                    ->maxDate(now()->subYears(18))
                    ->default(now()->subYears(18))
                    ->required('الرجاء ادخال تاريخ الميلاد'),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'ذكر',
                        'female' => 'انثى',
                ])
                    ->label('الجنس')

                    ->required('الرجاء ادخال الجنس'),
                // Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                ->password()
                ->required(fn(string $context) => $context === 'create')
                ->maxLength(255)
                ->dehydrateStateUsing(fn($state) => !empty ($state) ? Hash::make($state) : null)
                ->dehydrated(fn($state) => !empty ($state))

                ->label('كلمة المرور')
                ->maxLength(255),

                Forms\Components\TextInput::make('password_confirmation')
                ->password()
                ->required(fn(string $context) => $context === 'create')
                ->maxLength(255)
                ->dehydrateStateUsing(fn($state) => !empty ($state) ? Hash::make($state) : null)
                ->dehydrated(fn($state) => !empty ($state))
                ->label('تاكيد كلمة المرور')
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('البريد الالكتروني')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('رقم الهاتف')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('تاريخ الميلاد')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('الجنس')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->label(' التحقق من البريد الالكتروني')
                //     ->sortable(),
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
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTrainees::route('/'),
            'create' => Pages\CreateTrainee::route('/create'),
            'edit' => Pages\EditTrainee::route('/{record}/edit'),
        ];
    }
}
