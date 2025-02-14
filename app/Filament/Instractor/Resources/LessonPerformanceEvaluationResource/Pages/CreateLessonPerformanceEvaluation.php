<?php

namespace App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\Instractor\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use App\Models\Trainee;

class CreateLessonPerformanceEvaluation extends CreateRecord
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    public function getTitle(): string
    {
        return 'اضافة تقييم درس';
    }
    protected function afterCreate(): void
    {
        
        $trainees = Trainee::where('id', $this->record->trainee_id)->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم اضافة تقييم درس جديد')
            ->body('تم اضافة تقييم درس   ' .  ' بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->sendToDatabase($trainees);
    }
}
