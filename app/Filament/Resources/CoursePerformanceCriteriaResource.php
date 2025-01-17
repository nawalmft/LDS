<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoursePerformanceCriteriaResource\Pages;
use App\Filament\Resources\CoursePerformanceCriteriaResource\RelationManagers;
use App\Models\CoursePerformanceCriteria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoursePerformanceCriteriaResource extends Resource
{
    protected static ?string $model = CoursePerformanceCriteria::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = 'معايير أداء الدورات التدريبية';
    protected static ?string $modellabel = 'معيار أداء الدورة التدريبية';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->label(' الدورة')
                    ->options(function () {
                        return \App\Models\Course::all()->pluck('title', 'id');
                    })
                    ->required(),
                Forms\Components\TextInput::make('criteria')
                    ->required()
                    ->label('إسم المعيار')
                    ->maxLength(255),
                Forms\Components\Textarea::make('criteria_description')
                    ->required()    
                    ->label('وصف المعيار')
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_grade')
                    ->required()
                    ->label('المجموع')
                    ->numeric(),
                Forms\Components\TextInput::make('minimum_score')
                    ->required()
                    ->label('الحد الادنى')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.title')
                    ->numeric()
                    ->label(' الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('criteria')
                    ->label('المعيار')
                    ->searchable(),
                Tables\Columns\TextColumn::make('criteria_description')
                    ->label('وصف المعيار')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_grade')
                    ->numeric()
                    ->label('المجموع')
                    ->sortable(),
                Tables\Columns\TextColumn::make('minimum_score')
                    ->numeric() 
                    ->label('الحد الادنى')
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
            'index' => Pages\ListCoursePerformanceCriterias::route('/'),
            'create' => Pages\CreateCoursePerformanceCriteria::route('/create'),
            'edit' => Pages\EditCoursePerformanceCriteria::route('/{record}/edit'),
        ];
    }
}
