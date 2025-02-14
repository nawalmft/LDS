<?php

namespace App\Filament\Resources\TestResultResource\Pages;

use App\Filament\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
use App\Models\Trainee;

class CreateTestResult extends CreateRecord
{
    protected static string $resource = TestResultResource::class;

    public function getTitle(): string
    {
        return ' إضافة نتيجةاختبار';
    }

    protected function afterCreate(): void
    {
        $trainees = Trainee::all();// get all traees 
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة  نتيجةاختبار ')
            ->body('تم اضافة نتيجة  اختبار  ' .  ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($trainees);
    }
}
