<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;


class EditTest extends EditRecord
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }


    public function getTitle(): string
    {
        return 'تعديل إختبار';
    }

    protected function afterSave(): void
    {
        $admins = User::where('role', 'admin')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم تعديل اختبار')
            ->body('تم تعديل اختبار  بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->actions([
                Action::make('عرض')
                ->url(TestResource::getUrl('edit', ['record' => $this->record]))
            ])
            ->sendToDatabase($admins);
    }
}
