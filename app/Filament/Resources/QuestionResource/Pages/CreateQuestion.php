<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;


    public function getTitle(): string
    {
        return 'اضافة سؤال';
    }
 protected function afterCreate(): void
    {
     $admins = User::where('role', 'admin')->get();
     $this_user = auth()->user();
     Notification::make()
     ->title('تم اضافة سؤال جديد')
     ->body('تم اضافة سؤال  '. $this->record->question . 'بنجاح'.' من قبل ' . $this_user->name)
     ->icon('heroicon-o-question-mark-circle')
     ->success()
     ->sendToDatabase($admins);
 }
    
}
