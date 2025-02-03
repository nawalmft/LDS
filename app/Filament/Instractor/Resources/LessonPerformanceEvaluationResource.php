<?php

namespace App\Filament\Instractor\Resources;

use App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource\Pages;
use App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource\RelationManagers;
use App\Models\LessonPerformanceEvaluation;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\CoursePerformanceCriteria;

class LessonPerformanceEvaluationResource extends Resource
{
    protected static ?string $model = LessonPerformanceEvaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
       
    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = ' تقييمات أداء الدروس';
    protected static ?string $modellabel = ' تقييم اداء درس';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_criteria_id')
                    ->label('المعيار')
                    ->options(function () {
                        return CoursePerformanceCriteria::all()->pluck('criteria', 'id');
                    })
                    ->required(),
                Forms\Components\Select::make('lesson_id')
                    ->options(function () {
                        return \App\Models\Lesson::all()->pluck('title', 'id');
                    })
                    ->label('الدرس')
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
                    ->label('المعيار')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->numeric()
                    ->label('الدرس')
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
