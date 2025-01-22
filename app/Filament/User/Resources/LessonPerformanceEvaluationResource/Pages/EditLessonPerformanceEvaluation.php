<?php

namespace App\Filament\User\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\User\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLessonPerformanceEvaluation extends EditRecord
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
       
        ];
    }
}
