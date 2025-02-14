<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TestAttemptResource\Pages;
use App\Filament\User\Resources\TestAttemptResource\RelationManagers;
use App\Models\TestAttempt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestAttemptResource extends Resource
{
    protected static ?string $model = TestAttempt::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الإختبارات';
    protected static ?string $pluralLabel = ' محاولات الإختبارات';
    protected static ?string $modellabel = ' محاولة الإختبار';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_id')
                    ->required()
                    ->label('الأختبار')
                    ->numeric(),
                Forms\Components\TextInput::make('question_answer_id')
                    ->required()
                    ->label('السؤال')
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->label('المستخدم')
                    ->numeric(),
                Forms\Components\TextInput::make('trainee_id')
                    ->required()
                    ->label('الطالب')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test.test_name')
                    ->numeric()
                    ->label('الأختبار')
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_answer.question.question')
                    ->numeric()
                    ->label('السؤال')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label('المستخدم')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('trainee.name')
                    ->numeric()
                    ->label('المتدرب')
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('trainee_id',auth()->id());
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
