<?php

namespace App\Filament\User\Resources\TestResultResource\Pages;

use App\Filament\User\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestResults extends ListRecords
{
    protected static string $resource = TestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
         
        ];
    }
}
