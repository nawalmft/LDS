<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Models\Trainee;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
            
        ];
    }

    public function getTitle(): string
    {
        return 'تعديل' . ' ' . $this->record->name;
    }

    protected function afterSave(): void
    {
        $instructors = User::where('role', 'instructor')->get();
        $trainees = Trainee::all();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم تعديل دورة')
            ->body('تم تعديل دورة باسم ' . $this->record->title . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($instructors);
        Notification::make()
            ->title('تم تعديل دورة')
            ->body('تم تعديل دورة باسم ' . $this->record->title . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($trainees);
    }
}
