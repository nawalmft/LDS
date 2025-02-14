<?php

namespace App\Filament\User\Resources\TestAttemptResource\Pages;

use App\Filament\User\Resources\TestAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestAttempts extends ListRecords
{
    protected static string $resource = TestAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
