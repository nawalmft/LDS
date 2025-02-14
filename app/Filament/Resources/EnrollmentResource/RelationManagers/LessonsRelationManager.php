<?php

namespace App\Filament\Resources\EnrollmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';

    public function form(Form $form): Form
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

            Forms\Components\Select::make('status')
                ->label('الحالة')
                ->options([
                    'Scheduled' => 'مجدول',
                    'Completed' => 'مكتمل',
                    'Cancelled' => 'ملغي',
                    'In Progress' => 'قيد التنفيذ',
                ])
                ->required(),

            Forms\Components\DatePicker::make('start_date')
                ->label('تاريخ البدء')
                ->required(),

                Forms\Components\TimePicker::make('lessom_time')
                ->label('وقت الدرس')
                ->required(),
                
            Forms\Components\Textarea::make('notes')
                ->label('الملاحظات')
                ->columnSpanFull(),

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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
