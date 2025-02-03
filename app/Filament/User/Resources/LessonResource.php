<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\LessonResource\Pages;
use App\Filament\User\Resources\LessonResource\RelationManagers;
use App\Filament\User\Resources\LessonResource\RelationManagers\LessonperformanceevaluationsRelationManager;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    protected static ?string $navigationGroup = 'الدورات';
    protected static ?string $pluralLabel = ' الدروس';
    protected static ?string $modellabel = ' الدرس';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('enrollment_id')
                    ->required()
                    ->label('رقم التسجيل')
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->label('الحالة')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('تاريخ البدء')
                    ->required(),

                    Forms\Components\TimePicker::make('lesson_time')
                    ->required()
                    ->label('وقت  الدرس'),
                
                Forms\Components\Textarea::make('notes')
                    ->required()
                    ->label('ملاحظات')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('العنوان')
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->label('الوصف')
                    ->maxLength(255),
                    
                    Forms\Components\FileUpload::make('video')
                    ->preserveFilenames()
                    ->maxSize(20000),

                    Forms\Components\Select::make('video_type')
                    ->options([
                        'mp4' => 'mp4',
                        'mp3' => 'mp3',
                        'mkv' => 'mkv',
                        'mov' => 'mov',
                        'wmv' => 'wmv',
                        'vlc' => 'vlc',
                    ])
                    ->label('نوع الفيديو'),

                    Forms\Components\FileUpload::make('img')
                 
                    ->directory('images')
                    ->image()
                    ->label('صورة الدرس'),

                    Forms\Components\FileUpload::make('document')
                    
                    ->directory('documents')
                    ->label('رفع مستندات الدرس'),
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

                Tables\Columns\TextColumn::make('start_date')
                    ->label('تاريخ البدء')
                    ->date()
                    ->sortable(),
                
                    Tables\Columns\TextColumn::make('lesson_time')
                    ->label('وقت الدرس'),

                    Tables\Columns\TextColumn::make('status')
                    ->label('الحالة'),
               
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('description')
                //     ->label('الوصف')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('video')
                    ->label('الفيديو')
                    ->searchable(),

                // Tables\Columns\TextColumn::make('img')
                //     ->label('الصورة')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('pdf')
                //     ->label('الملف')
                //     ->searchable(),

                    // Tables\Columns\TextColumn::make('notes')
                    // ->label('ملاحظات')
                    // ->searchable(),

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

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->where('enrollment_id',auth()->id());
    // }

    public static function getRelations(): array
    {
        return [
            LessonperformanceevaluationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
        ];
    }
}
