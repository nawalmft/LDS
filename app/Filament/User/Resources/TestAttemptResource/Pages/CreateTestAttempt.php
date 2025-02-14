<?php

namespace App\Filament\User\Resources\TestAttemptResource\Pages;

use App\Filament\User\Resources\TestAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use App\Models\Trainee;

class CreateTestAttempt extends CreateRecord
{
    protected static string $resource = TestAttemptResource::class;
    protected function afterCreate(): void
    {
        $admins = User::where('role', 'admin')->get();
        $instructors = User::where('role', 'instructor')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة محاولة اختبار جديدة')
            ->body('تم اضافة محاولة اختبار جديدة  ' . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($instructors);
        Notification::make()
            ->title('تم اضافة محاولة اختبار جديدة')
            ->body('تم اضافة محاولة اختبار جديدة  ' .  ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($admins);
    }

    
}
