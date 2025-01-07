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
                Forms\Components\TextInput::make('course_criteria_id')
                    ->required()
                    ->label('رقم معيار الدورة')
                    ->numeric(),
                Forms\Components\TextInput::make('lesson_id')
                    ->required()
                    ->label('رقم الدرس')
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
                Tables\Columns\TextColumn::make('course_criteria_id')
                    ->numeric()
                    ->label('رقم معيار الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lesson_id')
                    ->numeric()
                    ->label('رقم الدرس')
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
