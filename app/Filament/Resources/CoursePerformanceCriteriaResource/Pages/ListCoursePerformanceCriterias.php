<?php

namespace App\Filament\Resources\CoursePerformanceCriteriaResource\Pages;

use App\Filament\Resources\CoursePerformanceCriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoursePerformanceCriterias extends ListRecords
{
    protected static string $resource = CoursePerformanceCriteriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('اضافة معايير الدورة'),
        ];
    }
}
