<?php

namespace App\Filament\Resources\LessonResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonperformanceevaluationsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessonperformanceevaluations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('trainee_id')
                ->label('المتدرب')
                ->options(function () {
                    return \App\Models\Trainee::all()->pluck('name', 'id');
                })
            ->required(),

            Forms\Components\Select::make('course_criteria_id')
                ->label(' معيار الدورة')
                ->options(function () {
                    return \App\Models\CoursePerformanceCriteria::all()->pluck('criteria', 'id');
                })
                ->required(),
            Forms\Components\Select::make('lesson_id')
                ->label(' الدرس')
                ->options(function () {
                    return \App\Models\Lesson::all()->pluck('title', 'id');
                })
                ->required(),
            Forms\Components\TextInput::make('grade')
                ->required()
                ->label('الدرجة')
                ->numeric(), 
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('grade')
            ->columns([
                Tables\Columns\TextColumn::make('lesson.title')
                    ->label('الدرس'),

                Tables\Columns\TextColumn::make('course_criteria.criteria')
                    ->label('المعيار'),

                Tables\Columns\TextColumn::make('grade')
                    ->label('الدرجة'),
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
