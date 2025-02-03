<?php

namespace App\Filament\Instractor\Resources\QuestionAnswerResource\Pages;

use App\Filament\Instractor\Resources\QuestionAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionAnswers extends ListRecords
{
    protected static string $resource = QuestionAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('اضافة جواب'),
        ];
    }
}
