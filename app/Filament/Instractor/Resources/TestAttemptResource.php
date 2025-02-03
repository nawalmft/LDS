<?php

namespace App\Filament\Instractor\Resources;

use App\Filament\Instractor\Resources\TestAttemptResource\Pages;
use App\Filament\Instractor\Resources\TestAttemptResource\RelationManagers;
use App\Models\TestAttempt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestAttemptResource extends Resource
{
    protected static ?string $model = TestAttempt::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الإختبارات';
    protected static ?string $pluralLabel = '  محاولات الإختبارات';
    protected static ?string $modellabel = '  محاولةالإختبار';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('test_id')
                    ->options(function () {
                        return \App\Models\Test::all()->pluck('test_type', 'id');
                    })
                    ->label('الإختبار')
                    ->required(),
                Forms\Components\TextInput::make('question_answer_id')
                    ->required()
                    ->label('رقم السؤال و الإجابة')
                    ->numeric(),
                Forms\Components\Select::make('user_id')
                    ->options(function () {
                        return \App\Models\User::Where('role', 'student')->pluck('name', 'id');
                    })
                    ->label('المستخدم')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test.test_type')
                    ->numeric()
                    ->label('الإختبار')
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_answer_id')
                    ->numeric()
                    ->label('رقم السؤال و الإجابة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label('المستخدم')
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   
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
            'index' => Pages\ListTestAttempts::route('/'),
            'create' => Pages\CreateTestAttempt::route('/create'),
            'edit' => Pages\EditTestAttempt::route('/{record}/edit'),
        ];
    }
}
