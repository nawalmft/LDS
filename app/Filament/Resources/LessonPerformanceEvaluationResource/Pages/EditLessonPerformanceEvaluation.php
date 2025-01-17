<?php

namespace App\Filament\Resources\LessonPerformanceEvaluationResource\Pages;

use App\Filament\Resources\LessonPerformanceEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class EditLessonPerformanceEvaluation extends EditRecord
{
    protected static string $resource = LessonPerformanceEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }

    public function getTitle(): string
    {
        return ' تعديل تقييم أداء الدرس';
    }

    protected function afterSave(): void
    {
        $admins = User::where('role', 'student')->get();
        $this_user = auth()->user();
        Notification::make()
            ->title('تم تعديل تقييم جديد')
            ->body('تم تعديل تقييم جديد بنجاح من قبل ' . $this_user->name)
            ->icon('heroicon-o-academic-cap')
            ->success()
            ->actions([
                Action::make('عرض')
                ->url(LessonPerformanceEvaluationResource::getUrl('edit', ['record' => $this->record]))
            ])
            ->sendToDatabase($admins);
    }   
}