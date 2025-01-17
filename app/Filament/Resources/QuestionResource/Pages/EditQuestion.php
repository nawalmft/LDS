<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }

    public function getTitle(): string
    {
        return 'تعديل '.'' . $this->record->question;
    }

    protected function afterSave(): void
    {
        $admins = User::where('role','admin')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم تعديل سؤال')
        ->body('تم تعديل سؤال  ' . $this->record->question . ' بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-question-mark-circle')
        ->success()
        ->actions([
        Action::make('عرض')
        ->url(QuestionResource::getUrl('edit', ['record' => $this->record]))
        ])
        ->sendToDatabase($admins);
    }
}
