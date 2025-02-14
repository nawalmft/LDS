<?php

namespace App\Filament\User\Resources\EnrollmentRequestResource\Pages;

use App\Filament\User\Resources\EnrollmentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Filament\Notifications\Notification;

class CreateEnrollmentRequest extends CreateRecord
{
    protected static string $resource = EnrollmentRequestResource::class;

    public function getTitle(): string
{
    return ' إضافة طلب تسجيل';
}
public function afterCreate(): void
{
$admin = User::where('role','admin')->get();
$this_user = auth()->user();
Notification::make()
    ->title('تم اضافة  طلب تسجيل جديد')
    ->body('تم اضافة طلب تسجيل جديد  ' . ' بنجاح من قبل ' . $this_user->name)
    ->icon('heroicon-o-academic-cap')
    ->success()
    ->sendToDatabase($admin);
}

}


