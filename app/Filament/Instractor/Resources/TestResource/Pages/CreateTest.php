<?php

namespace App\Filament\Instractor\Resources\TestResource\Pages;

use App\Filament\Instractor\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;

    public function getTitle(): string
    {
        return 'اضافة اختبار';
    }
}
