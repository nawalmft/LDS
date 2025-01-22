<?php

namespace App\Filament\Instractor\Resources\TestAttemptResource\Pages;

use App\Filament\Instractor\Resources\TestAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestAttempts extends ListRecords
{
    protected static string $resource = TestAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
