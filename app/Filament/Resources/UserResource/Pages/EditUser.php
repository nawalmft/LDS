<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }
    public function getTitle(): string
    {
        return 'تعديل ';
    }

    protected function afterSave(): void
    {
        $admins = User::where('role', 'admin')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم تعديل مستخدم')
            ->body('تم تعديل مستخدم بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->actions([
                Action::make('عرض')
                ->url(UserResource::getUrl('edit', ['record' => $this->record]))
            ])
            ->sendToDatabase($admins);
    }
}
