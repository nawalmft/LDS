<?php

namespace App\Filament\Resources\CoursePerformanceCriteriaResource\Pages;

use App\Filament\Resources\CoursePerformanceCriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
use App\Models\Trainee;

class CreateCoursePerformanceCriteria extends CreateRecord
{
    protected static string $resource = CoursePerformanceCriteriaResource::class;

    public function getTitle(): string
    {
        return 'اضافة معايير الدورة';
    }

    protected function afterCreate(): void
    {
        $instructors = User::where('role', 'instructor')->get();
        $trainees = Trainee::all();// get all traees 
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة معيار دورة  جديد')
            ->body('تم اضافة دورة جديدة بإسم ' . $this->record->criteria . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($instructors);
        Notification::make()
            ->title('تم اضافة  معيار دورة  جديد')
            ->body('تم اضافة  معيار دورة جديدة بإسم ' . $this->record->criteria . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($trainees);
    }
}
