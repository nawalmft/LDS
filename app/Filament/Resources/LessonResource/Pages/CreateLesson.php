<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\Trainee;

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
        $trainees = Trainee::where('id', $this->record->trainee_id)->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة درس جديد')
        ->body('نم إضافة درس جديد بإسم' . $this->record->title . ' بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->sendToDatabase($trainees);
 }
}
