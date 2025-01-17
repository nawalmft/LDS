<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    public function getTitle(): string
    {
        return 'اضافة دورة';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role', 'admin')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة دورة جديدة')
            ->body('تم اضافة دورة جديدة باسم ' . $this->record->title . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($admins);
    }
}
