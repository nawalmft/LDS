<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResultResource\Pages;
use App\Filament\Resources\TestResultResource\RelationManagers;
use App\Models\TestResult;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
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
                Forms\Components\Select::make('test_id')
                ->label(' الاختبار')
                ->options(function () {
                    return \App\Models\Test::all()->pluck('test_name', 'id');
                })
                ->required('الرجاء اختيار الاختبار'),

                Forms\Components\Select::make('user_id')
                ->label(' المدرب')
                ->options(function () {
                    return \App\Models\User::Where('role', 'student')->pluck('name', 'id');
                })
                ->required('الرجاء اختيار المدرب'),
                Forms\Components\Select::make('trainee_id')
                ->label(' المتدرب')
                ->options(function () {
                    return \App\Models\Trainee::all()->pluck('name', 'id');
                })
                ->required(),

                Forms\Components\TextInput::make('score')
                ->required('الرجاء ادخال الدرجة')
                ->label(' الدرجة')
                ->numeric(),

                Forms\Components\Select::make('status')
                ->label(' الحالة')
                ->options([
                    'ناجح' => 'ناجح',
                    'راسب ' => 'راسب ',
                ])
                ->required('الرجاء اختيار الحالة'),

                Forms\Components\TimePicker::make('time')
                ->label(' الوقت')
                ->required('الرجاء ادخال الوقت'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test.test_name')
                ->numeric()
                ->label(' الاختبار')
                ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                ->numeric()
                ->label(' المدرب')
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
            'index' => Pages\ListTestResults::route('/'),
            'create' => Pages\CreateTestResult::route('/create'),
            'edit' => Pages\EditTestResult::route('/{record}/edit'),
        ];
    }
}
