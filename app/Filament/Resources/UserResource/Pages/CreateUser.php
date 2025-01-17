<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'اضافة مستخدم';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role', 'admin')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة مستخدم جديد')
            ->body('تم اضافة مستخدم جديد بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($admins);
    }
}
