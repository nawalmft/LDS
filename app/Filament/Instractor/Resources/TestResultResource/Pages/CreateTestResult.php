<?php

namespace App\Filament\Instractor\Resources\TestResultResource\Pages;

use App\Filament\Instractor\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestResult extends CreateRecord
{
    protected static string $resource = TestResultResource::class;

    public function getTitle(): string
    {
        return 'اضافة نتيجة الاختبار';
    }
}
