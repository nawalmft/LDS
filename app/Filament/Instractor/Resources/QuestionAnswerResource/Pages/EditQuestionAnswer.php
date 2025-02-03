<?php

namespace App\Filament\Instractor\Resources\QuestionAnswerResource\Pages;

use App\Filament\Instractor\Resources\QuestionAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionAnswer extends EditRecord
{
    protected static string $resource = QuestionAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return ' تعديل جواب '.'' . $this->record->answer;
    }
}
