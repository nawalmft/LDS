<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestAttemptResource\Pages;
use App\Filament\Resources\TestAttemptResource\RelationManagers;
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
    protected static ?string $pluralLabel = ' محاولات الإختبارات';
    protected static ?string $modellabel = 'محاولة الإختبار ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_id')
                ->required()
                ->label('رقم الاختبار')
                ->numeric(),
                Forms\Components\TextInput::make(' question_answer_id')
                ->required()
                ->label('رقم إجابة السؤال')
                ->numeric(),
                Forms\Components\TextInput::make('user_id')
                ->required()
                ->label('رقم المستخدم')
                ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_id')
                ->numeric()
                ->label('رقم الاختبار')
                ->sortable(),
                Tables\Columns\TextColumn::make('question_answer_id')
                ->numeric()
                ->label('رقم إجابة السؤال')
                ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                ->numeric()
                ->label('رقم المستخدم')
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTestAttempts::route('/'),
            'create' => Pages\CreateTestAttempt::route('/create'),
            'edit' => Pages\EditTestAttempt::route('/{record}/edit'),
        ];
    }
}
