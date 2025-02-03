<?php

namespace App\Filament\Instractor\Resources\LessonResource\Pages;

use App\Filament\Instractor\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;
    public function getTitle(): string
    {
        return 'اضافة درس';
    }

    // protected function mutateFormDataBeforeCreate(array $data): array 
    // {
    //     $data['video_type'] = Storage::disk('public')->mimeType($data['video']);
 
    //     return $data;
    // } 

    protected function afterCreate(): void
    {
        $students = User::where('role', 'student')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة درس جديد')
        ->body('نم إضافة درس جديد بإسم' . $this->record->title . ' بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->sendToDatabase($students);
 }
}
