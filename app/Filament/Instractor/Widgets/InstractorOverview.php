<?php

namespace App\Filament\Instractor\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Lesson;
use App\Models\Trainee;
use App\Models\Test;
class InstractorOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $instractorId = auth()->user()->id;
        $lessons = Lesson::where('user_id', $instractorId)->count();
        $trainees = Trainee::whereHas('enrollment', function($query) use ($instractorId) {
            $query->where('user_id', $instractorId);
        })->count();
        $tests = Test::where('user_id', $instractorId)->get();


        return [
            Stat::make('الدروس', $lessons)
                ->description('عدد الدروس')
                ->descriptionIcon('heroicon-s-book-open')
                ->color('primary'),
            Stat::make('المتدربين', $trainees)
                ->description('عدد المتدربين')
                ->descriptionIcon('heroicon-s-users')
                ->color('success'),
            Stat::make('الاختبارات', $tests)
                ->description('عدد الاختبارات')
                ->descriptionIcon('heroicon-s-check-circle')
                ->color('success'),
        ];
    }
}
