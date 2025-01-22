<?php

namespace App\Filament\User\Resources\LessonResource\Pages;

use App\Filament\User\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;
}
