<?php

namespace App\Filament\Resources\TestAttemptResource\Pages;

use App\Filament\Resources\TestAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;


class CreateTestAttempt extends CreateRecord
{
    protected static string $resource = TestAttemptResource::class;

    public function getTitle(): string
    {
        return 'محاولات الاختبار';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role', 'instructor')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة محاولة جديدة')
        ->body('تم اضافة محاولة جديدة بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->sendToDatabase($admins);
    }
}
