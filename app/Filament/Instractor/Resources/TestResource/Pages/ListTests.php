<?php

namespace App\Filament\Instractor\Resources\TestResource\Pages;

use App\Filament\Instractor\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTests extends ListRecords
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('اضافة اختبار'),
        ];
    }
}
