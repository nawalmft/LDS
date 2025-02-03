<?php

namespace App\Filament\Instractor\Resources\TestAttemptResource\Pages;

use App\Filament\Instractor\Resources\TestAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestAttempt extends CreateRecord
{
    protected static string $resource = TestAttemptResource::class;
     
    public function getTitle(): string
    {
        return 'اضافة محاولة اختبار';
    }
}
