<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;

    public function getTitle(): string
    {
        return 'اضافة درس';
    }

    protected function afterCreate(): void
    {
        $admins = User::where('role', 'admin')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة درس جديد')
        ->body('نم إضافة درس جديد بإسم' . $this->record->title . ' بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->sendToDatabase($admins);
 }
}
