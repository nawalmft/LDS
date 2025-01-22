<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'المستخدمين';
    protected static ?string $pluralLabel = 'المستخدمين';
    protected static ?string $modelLabel = 'المستخدم';
    



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('الاسم')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('البريد الالكتروني')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->label('رقم الهاتف')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->label('الصورة'),
                Forms\Components\Select::make('role')
                    ->required()
                    ->label('الصلاحية')
                    ->options([
                        'admin' => 'ادمن',
                        'student' => 'طالب',
                        'instructor' => 'مدرب',
                    ])
                    ->default('user'),
                Forms\Components\DateTimePicker::make('date_of_birth')
                    ->label('تاريخ الميلاد'),
                Forms\Components\Select::make('gender')
                    ->label('الجنس')
                    ->options([
                        'male' => 'ذكر',
                        'female' => 'انثى',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn(string $context) => $context === 'create')
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => !empty ($state) ? Hash::make($state) : null)
                    ->dehydrated(fn($state) => !empty ($state))

                    ->label('كلمة المرور')
                    ->maxLength(255),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('البريد الالكتروني'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('رقم الهاتف'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة'),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->label('الصلاحية'),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable()
                    ->label('الجنس'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
