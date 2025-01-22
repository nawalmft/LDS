<?php

namespace App\Filament\User\Resources\LessonResource\Pages;

use App\Filament\User\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
         
        ];
    }
}
