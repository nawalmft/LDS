<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = 'الدروس';
    protected static ?string $modellabel = 'الدرس';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('عنوان الدرس')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('الوصف')    
                    ->columnSpanFull(),
                Forms\Components\Select::make('enrollment_id')
                    ->label(' التسجيل')
                    ->options(function () {
                        return \App\Models\Enrollment::all()->pluck('id', 'id');
                    })
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->label('الحالة')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('تاريخ البدء')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->required()
                    ->label('الملاحظات')
                    ->columnSpanFull(),


                    Forms\Components\FileUpload::make('video')
                    ->required()
                    ->preserveFilenames()
                    ->maxSize(20000),

                    Forms\Components\Select::make('video_type')
                    ->required()
                    ->options([
                        'mp4' => 'mp4',
                        'mp3' => 'mp3',
                        'mkv' => 'mkv',
                        'mov' => 'mov',
                        'wmv' => 'wmv',
                        'vlc' => 'vlc',
                    ])
                    ->label('نوع الفيديو'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('enrollment_id')
                    ->numeric()
                    ->label('رقم التسجيل')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->label('الحالة')
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
