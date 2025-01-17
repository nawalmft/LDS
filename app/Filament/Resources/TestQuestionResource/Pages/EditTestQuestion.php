<?php

namespace App\Filament\Resources\TestQuestionResource\Pages;

use App\Filament\Resources\TestQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditTestQuestion extends EditRecord
{
    protected static string $resource = TestQuestionResource::class;

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
        $admins = User::where('role','admin')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم تعديل سؤال')
        ->body('تم تعديل سؤال  ' . $this->record->question . ' بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->actions([
        Action::make('عرض')
        ->url(TestQuestionResource::getUrl('edit', ['record' => $this->record]))
        ])
        ->sendToDatabase($admins);
    }
}
