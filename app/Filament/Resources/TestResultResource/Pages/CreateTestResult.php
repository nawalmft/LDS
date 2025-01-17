<?php

namespace App\Filament\Resources\TestResultResource\Pages;

use App\Filament\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;

class CreateTestResult extends CreateRecord
{
    protected static string $resource = TestResultResource::class;

    public function getTitle(): string
    {
        return 'نتيجة الاختبار';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role', 'student')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة نتيجة جديدة')
        ->body('تم اضافة نتيجة جديدة بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->sendToDatabase($admins);
    }
}
