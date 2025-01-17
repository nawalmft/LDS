<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use App\Models\Lesson;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }

    public function getTitle(): string
    {
        return 'تعديل '.'' . $this->record->title;
    }

    protected function afterSave(): void
    {
   $admins = User::where('role','admin')->get();
   $this_user = auth()->user();
   Notification::make()
   ->title('تم تعديل درس')
   ->body('تم تعديل درس  ' . $this->record->title . ' بنجاح من قبل ' . $this_user->name)
   ->icon('heroicon-o-academic-cap')
   ->success()
   ->actions([
       Action::make('عرض')
       ->url(LessonResource::getUrl('edit', ['record' => $this->record]))
   ])
   ->sendToDatabase($admins);
    }
}
