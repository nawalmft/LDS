<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionAnswerResource\Pages;
use App\Filament\Resources\QuestionAnswerResource\RelationManagers;
use App\Models\QuestionAnswer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionAnswerResource extends Resource
{
    protected static ?string $model = QuestionAnswer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    
    protected static ?string $navigationGroup = 'الأسئلة';
    protected static ?string $pluralLabel = ' إجابات الأسئلة';
    protected static ?string $modellabel = 'إجابة السؤال';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question_id')
                    ->required()
                    ->label('رقم السؤال')
                    ->numeric(),
                Forms\Components\Textarea::make('answer')
                    ->required()
                    ->label('الجواب')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_correct')
                    ->required()
                    ->label('الجواب الصحيح'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question_id')
                    ->numeric()
                    ->label('رقم السؤال')
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer')
                    ->label('الجواب')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_correct')
                    ->boolean()
                    ->label('الجواب الصحيح'),
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
            'index' => Pages\ListQuestionAnswers::route('/'),
            'create' => Pages\CreateQuestionAnswer::route('/create'),
            'edit' => Pages\EditQuestionAnswer::route('/{record}/edit'),
        ];
    }
}
