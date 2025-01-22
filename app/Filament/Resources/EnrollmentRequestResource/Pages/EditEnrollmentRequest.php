<?php

namespace App\Filament\Resources\EnrollmentRequestResource\Pages;

use App\Filament\Resources\EnrollmentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;

class EditEnrollmentRequest extends EditRecord
{
    protected static string $resource = EnrollmentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }

    public function getTitle(): string
    {
        return 'تعديل '. '' . $this->record->user->name . ' ' . $this->record->course->name;
    }


    protected function afterSave(): void
    {
        $student = User::where('id', $this->record->user_id)->get();

        Notification::make()
            ->title('تم تغير حالة طلب التسجيل')
            ->body('تم تغير حالة طلب التسجيل بنجاح ')
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($student);
    }
}
