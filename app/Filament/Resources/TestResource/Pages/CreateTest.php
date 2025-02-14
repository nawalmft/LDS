<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
use App\Models\Trainee;
class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;

    public function getTitle(): string
    {
        return 'اضافة اختبار';
    }

    protected function afterCreate(): void
    {
        $trainees = Trainee::all();// get all traees 
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة  اختبار جديد')
            ->body('تم اضافة  اختبار جديد باسم ' . $this->record->test_name . ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($trainees);
    }
  
}
