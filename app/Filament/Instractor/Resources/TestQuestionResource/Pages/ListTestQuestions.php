<?php

namespace App\Filament\Instractor\Resources\TestQuestionResource\Pages;

use App\Filament\Instractor\Resources\TestQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestQuestions extends ListRecords
{
    protected static string $resource = TestQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
