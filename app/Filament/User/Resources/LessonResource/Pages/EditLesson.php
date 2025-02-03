<?php

namespace App\Filament\User\Resources\LessonResource\Pages;

use App\Filament\User\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
         
        ];
    }

    public function getTitle(): string
    {
        return 'عرض الدرس ';
    }
}

