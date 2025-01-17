<?php

namespace App\Filament\Resources\CoursePerformanceCriteriaResource\Pages;

use App\Filament\Resources\CoursePerformanceCriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;

class CreateCoursePerformanceCriteria extends CreateRecord
{
    protected static string $resource = CoursePerformanceCriteriaResource::class;

    public function getTitle(): string
    {
        return 'اضافة معايير الدورة';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role', 'admin')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة معيار جديد')
            ->body('تم اضافة معيار جديد بنجاح بإسم '. $this->record->criteria. ' من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($admins);
    }
}
