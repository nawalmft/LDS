<?php

namespace App\Filament\Instractor\Resources;

use App\Filament\Instractor\Resources\TestResource\Pages;
use App\Filament\Instractor\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الإختبارات';
    protected static ?string $pluralLabel = ' الإختبارات';
    protected static ?string $modellabel = ' الإختبار';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->label('الدورة')
                    ->options(function () {
                        return \App\Models\Course::all()->pluck('title', 'id');
                    })
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('الطالب')
                    ->options(function () {
                        return \App\Models\User::Where('role', 'instructor')->pluck('name', 'id');
                    })
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->required()
                    ->label('المدة')
                    ->numeric(),
                Forms\Components\TextInput::make('total_grade')
                    ->required()
                    ->label('الدرجة الكلية')
                    ->numeric(),
                Forms\Components\TextInput::make('passing_score')
                    ->required()
                    ->label('درجة النجاح')
                    ->numeric()
                    ->default(75),
                Forms\Components\DatePicker::make('start_date')
                    ->label('تاريخ البدء')
                    ->required(),
                Forms\Components\TextInput::make('test_type')
                    ->label('نوع الاختبار')
                    ->required(),
                Forms\Components\TextInput::make('total_questions')
                    ->required()
                    ->label('عدد الاسئلة')
                    ->numeric()
                    ->default(0),
                Forms\Components\DateTimePicker::make('datetime_start')
                    ->label('تاريخ ووقت البدء')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.title')
                    ->numeric()
                    ->label('الدورة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label('الطالب')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->label('المدة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_grade')
                    ->numeric()
                    ->label('الدرجة الكلية')
                    ->sortable(),
                Tables\Columns\TextColumn::make('passing_score')
                    ->numeric()
                    ->label('درجة النجاح')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->label('تاريخ البدء')
                    ->sortable(),
                Tables\Columns\TextColumn::make('test_type')
                    ->label('نوع الأختبار'),
                Tables\Columns\TextColumn::make('total_questions')
                    ->numeric()
                    ->label('عدد الاسئلة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('datetime_start')
                    ->dateTime()
                    ->label('تاريخ ووقت البدء')
                    ->sortable(),
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
