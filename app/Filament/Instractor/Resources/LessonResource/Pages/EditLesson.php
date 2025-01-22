<?php

namespace App\Filament\Instractor\Resources\LessonResource\Pages;

use App\Filament\Instractor\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return ' تعديل درس '.'' . $this->record->title;
    }
}
