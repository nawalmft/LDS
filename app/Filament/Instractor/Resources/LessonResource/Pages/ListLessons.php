<?php

namespace App\Filament\Instractor\Resources\LessonResource\Pages;

use App\Filament\Instractor\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('اضافة درس'),
        ];
    }
}
