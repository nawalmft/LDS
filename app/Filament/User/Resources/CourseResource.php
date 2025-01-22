<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\CourseResource\Pages;
use App\Filament\User\Resources\CourseResource\RelationManagers;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = ' الدورات';
    protected static ?string $modellabel = ' الدورة'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('عنوان الدورة')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('وصف الدورة')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('fee')
                    ->required()
                    ->label('رسوم الإشتراك في الدورة')
                    ->numeric(),
                Forms\Components\TextInput::make('course_duration')
                    ->required()
                    ->label('مدة الدورة')
                    ->numeric(),
                Forms\Components\TextInput::make('hours_per_day')
                    ->required()
                    ->label('عدد الساعات الموصى بها في اليوم ')
                    ->numeric(),
                Forms\Components\TextInput::make('transmission_type')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان الدورة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fee')
                    ->numeric()
                    ->label('رسوم الإشتراك في الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('course_duration')
                    ->numeric()
                    ->label('عدد الأيام الموصى بها في الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('hours_per_day')
                    ->numeric()
                    ->label('عدد الساعات الموصى بها في اليوم ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transmission_type')
                    ->label('نوع النقل')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   
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

        ];
    }
}
