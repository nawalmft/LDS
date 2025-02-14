<?php

namespace App\Filament\User\Resources\TestResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestQuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'test_questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_id')
            ->columns([
                Tables\Columns\TextColumn::make('question.question'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                
            ])
            ->actions([

            ]);

        
    }
}
