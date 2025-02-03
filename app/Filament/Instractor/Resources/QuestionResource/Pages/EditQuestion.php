<?php

namespace App\Filament\Instractor\Resources\QuestionResource\Pages;

use App\Filament\Instractor\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return ' تعديل سؤال  '.'' . $this->record->question;
    }
}
