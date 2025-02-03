<?php

namespace App\Filament\Instractor\Resources;

use App\Filament\Instractor\Resources\TestQuestionResource\Pages;
use App\Filament\Instractor\Resources\TestQuestionResource\RelationManagers;
use App\Models\TestQuestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestQuestionResource extends Resource
{
    protected static ?string $model = TestQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الإختبارات';
    protected static ?string $pluralLabel = ' أسئلة الإختبارات';
    protected static ?string $modellabel = ' سؤال الإختبار';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('question_id')
                    ->options(function () {
                        return \App\Models\Question::all()->pluck('question', 'id');
                    })
                    ->label('السؤال')
                    ->required(),
                Forms\Components\Select::make('test_id')
                    ->options(function () {
                        return \App\Models\Test::all()->pluck('test_type', 'id');
                    })
                    ->label('الاختبار')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question.question')
                    ->numeric()
                    ->label('السؤال')
                    ->sortable(),
                Tables\Columns\TextColumn::make('test.test_type')
                    ->numeric()
                    ->label('الاختبار')
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
            'index' => Pages\ListTestQuestions::route('/'),
            'create' => Pages\CreateTestQuestion::route('/create'),
            'edit' => Pages\EditTestQuestion::route('/{record}/edit'),
        ];
    }
}
