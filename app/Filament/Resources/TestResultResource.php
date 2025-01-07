<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResultResource\Pages;
use App\Filament\Resources\TestResultResource\RelationManagers;
use App\Models\TestResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResultResource extends Resource
{
    protected static ?string $model = TestResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'الإختبارات';
    protected static ?string $pluralLabel = ' نتائج الإختبارات';
    protected static ?string $modellabel = 'نتيجة الإختبار ';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_id')
                ->required()
                ->label('رقم الاختبار')
                ->numeric(),
                Forms\Components\TextInput::make('user_id')
                ->required()
                ->label('رقم المستخدم')
                ->numeric(),
                Forms\Components\TextInput::make('score')
                ->required()
                ->label(' الدرجة')
                ->numeric(),
                Forms\Components\TextInput::make('time')
                ->required()
                ->label(' الوقت')
                ->numeric(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_id')
                ->numeric()
                ->label('رقم الاختبار')
                ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                ->numeric()
                ->label('رقم المستخدم')
                ->sortable(),
                Tables\Columns\TextColumn::make('score')
                ->numeric()
                ->label(' الدرجة')
                ->sortable(),
                Tables\Columns\TextColumn::make('time')
                ->numeric()
                ->label(' الوقت')
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
            'index' => Pages\ListTestResults::route('/'),
            'create' => Pages\CreateTestResult::route('/create'),
            'edit' => Pages\EditTestResult::route('/{record}/edit'),
        ];
    }
}
