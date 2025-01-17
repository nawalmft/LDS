<?php

namespace App\Filament\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Notifications\Notification;

class CreateLessonPerformanceEvaluation extends CreateRecord
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    public function getTitle(): string
    {
        return 'تقييم أداء الدرس';
    }
    
    protected function afterCreate(): void
    {
        $admins = User::where('role', 'student')->get();
        $this_user = auth()->user();
        Notification::make()
        ->title('تم اضافة تقييم جديد')
        ->body('تم اضافة تقييم جديد بنجاح من قبل ' . $this_user->name)
        ->icon('heroicon-o-academic-cap')
        ->success()
        ->sendToDatabase($admins);
    }
}
