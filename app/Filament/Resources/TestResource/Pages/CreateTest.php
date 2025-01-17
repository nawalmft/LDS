<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;

    public function getTitle(): string
    {
        return 'اضافة اختبار';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role','student')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة اختبار')        
        ->body('تم اضافة اختبار بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->sendToDatabase($admins);
    }
  
}
