<?php

namespace App\Filament\User\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\User\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessonPerformanceEvaluations extends ListRecords
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()->label('اضافة تقييم الدرس'),
        ];
    }
}
