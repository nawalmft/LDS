<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\EnrollmentRequest;
use App\Models\Enrollment;
use App\Models\Course;

class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {

        $usersCount = User::count();
        $enrollmentRequestsCount = EnrollmentRequest::count();
        $enrollmentsCount = Enrollment::count();
        $coursesCount = Course::count();
        return [
            Stat::make('Users', $usersCount)
            ->description('مستخدمين النظام')
            ->descriptionIcon('heroicon-s-users'),
            Stat::make('Enrollment Requests', $enrollmentRequestsCount)
            ->description('طلبات التسجيل')
            ->descriptionIcon('heroicon-s-users'),
            Stat::make('Enrollments', $enrollmentsCount)
            ->description('التسجيلات')
            ->descriptionIcon('heroicon-s-users'),
            Stat::make('Courses', $coursesCount)
            ->description('الدورات')
            ->descriptionIcon('heroicon-o-academic-cap'),
        ];
    }
}
