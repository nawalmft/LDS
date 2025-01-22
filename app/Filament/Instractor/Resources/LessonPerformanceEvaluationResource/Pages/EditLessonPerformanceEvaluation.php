<?php

namespace App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLessonPerformanceEvaluation extends EditRecord
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return ' تعديل تقييم '.'' . $this->record->lesson->title;
    }
}
