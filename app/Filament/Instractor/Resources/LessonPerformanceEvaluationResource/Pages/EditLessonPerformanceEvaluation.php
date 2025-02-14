<?php

namespace App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Trainee;
use Filament\Notifications\Notification;


class EditLessonPerformanceEvaluation extends EditRecord
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return ' تعديل تقييم '.'' . $this->record->lesson->title;
    }
    
    protected function afterSave(): void
    {
        
        $trainees = Trainee::where('id', $this->record->trainee_id)->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم تعديل تقييم درس ')
            ->body('تم تعديل تقييم درس   ' .  ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($trainees);
    }
}
