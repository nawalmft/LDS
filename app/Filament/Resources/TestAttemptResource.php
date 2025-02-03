<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestAttemptResource\Pages;
use App\Filament\Resources\TestAttemptResource\RelationManagers;
use App\Models\TestAttempt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class TestAttemptResource extends Resource
{
    protected static ?string $model = TestAttempt::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الإختبارات';
    protected static ?string $pluralLabel = ' محاولات الإختبارات';
    protected static ?string $modellabel = 'محاولة الإختبار ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('test_id')
                ->label(' الاختبار')
                ->options(function () {
                    return \App\Models\Test::all()->pluck('id', 'id');
                    
                })
                ->required(),

                Forms\Components\Select::make('question_answer_id')
                ->label(' إجابة السؤال')
                ->options(
                    \App\Models\QuestionAnswer::all()->pluck('answer', 'id')
                )
                ->required(),
                
                Forms\Components\Select::make('user_id')
                ->label(' المستخدم')
                ->options(function () {
                    return \App\Models\User::Where('role', 'student')->pluck('name', 'id');
                })
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test.test_type')
                ->numeric()
                ->label(' الاختبار')
                ->sortable(),
                Tables\Columns\TextColumn::make('question_answer.question.question')
                ->numeric()
                ->label(' السؤال')
                ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                ->numeric()
                ->label(' المستخدم')
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
            'index' => Pages\ListTestAttempts::route('/'),
            'create' => Pages\CreateTestAttempt::route('/create'),
            'edit' => Pages\EditTestAttempt::route('/{record}/edit'),
        ];
    }
}
