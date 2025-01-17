<?php

namespace App\Filament\Resources\CoursePerformanceCriteriaResource\Pages;

use App\Filament\Resources\CoursePerformanceCriteriaResource;
use App\Models\Course;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditCoursePerformanceCriteria extends EditRecord
{
    protected static string $resource = CoursePerformanceCriteriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }
    
    public function getTitle(): string
    {
        return '  تعديل معيار الدورة';
    }

    protected function afterSave(): void
    {
        $admins = User::where('role', 'admin')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم تعديل معيار الدورة')
            ->body('تم تعديل  ' . $this->record->criteria . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->actions([
                Action::make('عرض')
                ->url(CoursePerformanceCriteriaResource::getUrl('edit', ['record' => $this->record]))
                ])
            ->sendToDatabase($admins);
    }

}
