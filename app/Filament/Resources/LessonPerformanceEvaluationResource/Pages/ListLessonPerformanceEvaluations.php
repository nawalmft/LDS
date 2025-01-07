<?php

namespace App\Filament\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessonPerformanceEvaluations extends ListRecords
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
