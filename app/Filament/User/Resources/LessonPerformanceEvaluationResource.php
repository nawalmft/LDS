<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\LessonPerformanceEvaluationResource\Pages;
use App\Filament\User\Resources\LessonPerformanceEvaluationResource\RelationManagers;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
      
    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = ' تقييمات أداء الدروس';
    protected static ?string $modellabel = ' تقييم اداء درس';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('course_criteria_id')
                    ->required()
                    ->label('المعيار')
                    ->numeric(),
                Forms\Components\TextInput::make('lesson_id')
                    ->required()
                    ->label('الدرس')
                    ->numeric(),
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
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
            
                ]),
            ]);
    }


    public static function getEloquentQuery(): Builder
    {
        // the lesson_id should be the user id
        return parent::getEloquentQuery()->where('trainee_id',auth()->user()->id);
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
