<?php

namespace App\Filament\Resources\TestResultResource\Pages;

use App\Filament\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditTestResult extends EditRecord
{
    protected static string $resource = TestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }
    public function getTitle(): string
    {
        return ' تعديل نتيجة الاختبار';
    }

    protected function afterSave(): void
    {
        $admins = User::where('role', 'student')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم تعديل نتيجة الاختبار')
        ->body('تم تعديل نتيجة الاختبار بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->actions([
        Action::make('عرض')
              ->url(TestResultResource::getUrl('edit', ['record' => $this->record]))
        ])
        ->sendToDatabase($admins);
    }
}
