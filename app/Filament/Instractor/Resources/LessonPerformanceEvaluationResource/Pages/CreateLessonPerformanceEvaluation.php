<?php

namespace App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLessonPerformanceEvaluation extends CreateRecord
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    public function getTitle(): string
    {
        return 'اضافة تقييم درس';
    }
}
