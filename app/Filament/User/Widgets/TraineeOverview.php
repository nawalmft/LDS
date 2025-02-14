<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Test;

use App\Models\Lesson;

class TraineeOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $trainee_id = auth()->user()->id;
        $trainee_lessons = Lesson::where('trainee_id', $trainee_id)->count();
        $trainee_completed_lessons = Lesson::where('trainee_id', $trainee_id)->where('status', 'Completed')->count();
        $trainee_tests = Test::where('trainee_id', $trainee_id)->count();

        return [
            Stat::make('الدروس', $trainee_lessons)
                ->description('عدد الدروس')
                ->descriptionIcon('heroicon-s-book-open')
                ->color('primary'),
            Stat::make('الدروس المكتملة', $trainee_completed_lessons)
            ->description('عدد الدروس المكتملة')
            ->descriptionIcon('heroicon-s-check-circle')
            ->color('success'),
            Stat::make('الاختبارات', $trainee_tests)
            ->description('عدد الاختبارات')
            ->descriptionIcon('heroicon-s-check-circle')
            ->color('success'),
        ];
    }
}
