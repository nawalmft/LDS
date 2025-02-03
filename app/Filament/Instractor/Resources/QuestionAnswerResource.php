<?php

namespace App\Filament\Instractor\Resources;

use App\Filament\Instractor\Resources\QuestionAnswerResource\Pages;
use App\Filament\Instractor\Resources\QuestionAnswerResource\RelationManagers;
use App\Models\QuestionAnswer;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionAnswerResource extends Resource
{
    protected static ?string $model = QuestionAnswer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الأسئلة';
    protected static ?string $pluralLabel = 'إجابات الأسئلة';
    protected static ?string $modellabel = 'إجابة السؤال';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('question_id')
                    ->required()
                    ->options(function () {
                        return \App\Models\Question::all()->pluck('question', 'id');
                    })
                    ->label('السؤال'),
                Forms\Components\Textarea::make('answer')
                    ->required()
                    ->label('الاجابة')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_correct')
                    ->label('الاجابة صحيحة')
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

                Tables\Columns\TextColumn::make('answer')
                    ->label('الاجابة')
                    ->searchable(),

                Tables\Columns\TextColumn::make('is_correct')
                    ->label('الاجابة صحيحة')
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
            'index' => Pages\ListQuestionAnswers::route('/'),
            'create' => Pages\CreateQuestionAnswer::route('/create'),
            'edit' => Pages\EditQuestionAnswer::route('/{record}/edit'),
        ];
    }
}
