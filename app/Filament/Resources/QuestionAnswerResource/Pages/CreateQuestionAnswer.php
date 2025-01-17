<?php

namespace App\Filament\Resources\QuestionAnswerResource\Pages;

use App\Filament\Resources\QuestionAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Filament\Notifications\Notification;
class CreateQuestionAnswer extends CreateRecord
{
    protected static string $resource = QuestionAnswerResource::class;
    
    public function getTitle(): string
    {
        return 'اضافة اجابة';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role','admin')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة جواب')
        ->body('تم اضافة جواب  ' . $this->record->answer . ' بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-question-mark-circle')
        ->success()
        ->sendToDatabase($admins);
    }
}
