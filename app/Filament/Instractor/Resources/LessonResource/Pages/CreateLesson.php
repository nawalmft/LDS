<?php

namespace App\Filament\Instractor\Resources\LessonResource\Pages;

use App\Filament\Instractor\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;
    public function getTitle(): string
    {
        return 'اضافة درس';
    }
}
