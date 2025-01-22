<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;


class ViewVideo extends ViewRecord
{
    protected static string $resource = LessonResource::class;

    protected static string $view = 'filament.pages.view-video';
}
