<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;

class MonthlyRegistrationsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'احصائيات التسجيلات الشهرية';

    protected function getData(): array
    {
        $data = [];
        $lables = [];
        # 
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = User::whereMonth('created_at', $month->month)->whereYear('created_at', $month->year)->count();
            $lables[] = $month->format('M Y');
            $data[] = $count;
        }
        return [
            'datasets' => [
                [
                    'label' => 'التسجيلات',
                    'data' => $data,
                    // 'backgroundColor' => 'rgba(53, 162, 235, 0.5)',
                    // 'borderColor' => 'rgba(53, 162, 235, 1)',
                    // 'borderWidth' => 1,
                ],
            ],
            'labels' => $lables,
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}
