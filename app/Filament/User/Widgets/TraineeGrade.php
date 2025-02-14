<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\LessonPerformanceEvaluation;
use Illuminate\Support\Facades\Auth;

class TraineeGrade extends ChartWidget
{
    protected static ?string $heading = 'الدرجات التي حصل عليها المتدرب';

    protected function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }
    protected function getData(): array
    {
        $traineeId = Auth::id();
        
        $evaluations = LessonPerformanceEvaluation::where('trainee_id', $traineeId)
            ->orderBy('created_at')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'الدرجات',
                    'data' => $evaluations->pluck('grade')->toArray(),
                    'borderColor' => '#10B981',
                    'fill' => false,
                ]
            ],
            'labels' => $evaluations->pluck('created_at')->map(function($date) {
                return $date->format('M d');
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
