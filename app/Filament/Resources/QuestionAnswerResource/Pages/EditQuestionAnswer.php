<?php

namespace App\Filament\Resources\QuestionAnswerResource\Pages;

use App\Filament\Resources\QuestionAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditQuestionAnswer extends EditRecord
{
    protected static string $resource = QuestionAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }

    public function getTitle(): string
    {
        return 'تعديل '.'' . $this->record->answer;
    }

    protected function afterSave(): void
    {
        $admins = User::where('role','admin')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم تعديل جواب')
        ->body('تم تعديل جواب  ' . $this->record->answer . ' بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-question-mark-circle')
        ->success()
        ->actions([
        Action::make('عرض')
        ->url(QuestionAnswerResource::getUrl('edit', ['record' => $this->record]))
        ])
        ->sendToDatabase($admins);
    }
}
