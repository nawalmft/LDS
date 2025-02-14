<?php

namespace App\Filament\User\Resources\TestResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Trainee;
class TestAttemptRelationManager extends RelationManager
{
    protected static string $relationship = 'test_attempt';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('trainee_id')
                    ->default(auth()->user()->id)
                    ->disabled(),

                Forms\Components\Select::make('question_answer_id')
                    ->required()
                    ->label('Answer')
                    ->options(function () {
                        // First get the test question for this test
                        $testQuestion = \App\Models\TestQuestion::where('test_id', $this->ownerRecord->id)->first();
                        
                        if ($testQuestion) {
                            // Then get all answers for that question
                            return \App\Models\QuestionAnswer::where('question_id', $testQuestion->question_id)
                                ->pluck('answer', 'id');
                        }
                        return [];
                    })
                    ->helperText(function () {
                        $testQuestion = \App\Models\TestQuestion::where('test_id', $this->ownerRecord->id)
                            ->first();
                        return $testQuestion ? $testQuestion->question->question : '';
                    })
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_answer_id')
            ->columns([
                Tables\Columns\TextColumn::make('question_answer.question.question')
                    ->label('السؤال'),
                Tables\Columns\TextColumn::make('question_answer.answer')
                    ->label('الاجابة'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
