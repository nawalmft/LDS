<?php

namespace App\Filament\Resources\CoursePerformanceCriteriaResource\Pages;

use App\Filament\Resources\CoursePerformanceCriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoursePerformanceCriteria extends EditRecord
{
    protected static string $resource = CoursePerformanceCriteriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
