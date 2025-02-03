<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonPerformanceEvaluationResource\Pages;
use App\Filament\Resources\LessonPerformanceEvaluationResource\RelationManagers;
use App\Models\LessonPerformanceEvaluation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonPerformanceEvaluationResource extends Resource
{
    protected static ?string $model = LessonPerformanceEvaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = 'تقييم أداء الدروس';
    protected static ?string $modellabel = 'نفييم أداء الدرس';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course_criteria.criteria')
                    ->numeric()
                    ->label(' معيار الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->numeric()
                    ->label(' الدرس')
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade')
                    ->numeric()
                    ->label('الدرجة')
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
            'index' => Pages\ListLessonPerformanceEvaluations::route('/'),
            'create' => Pages\CreateLessonPerformanceEvaluation::route('/create'),
            'edit' => Pages\EditLessonPerformanceEvaluation::route('/{record}/edit'),
        ];
    }
}
