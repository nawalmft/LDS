<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = 'الدورات';
    protected static ?string $modellabel = 'دورة';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('العنوان')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('الوصف')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('fee')
                    ->required()
                    ->label('رسوم الدورة')
                    ->numeric(),
                Forms\Components\TextInput::make('course_duration')
                    ->required()
                    ->label('مدة الدورة')
                    ->numeric(),
                Forms\Components\TextInput::make('hours_per_day')
                    ->required()
                    ->label('عدد ساعات في اليوم')
                    ->numeric(),
                Forms\Components\Select::make('transmission_type')
                    ->required()
                    ->options([
                        'automatic' => 'أوتوماتيكي',
                        'manual' => 'يدوي',
                    ])
                    ->label('نوع المركبة'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->label('العنوان')   
                ->searchable(),
                Tables\Columns\TextColumn::make('fee')
                    ->numeric()
                    ->label('رسوم الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('course_duration')
                    ->numeric()
                    ->label('مدة الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('hours_per_day')
                    ->numeric()
                    ->label('عدد ساعات في اليوم')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transmission_type')
                    ->label('نوع النقل')
                    ->sortable(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
