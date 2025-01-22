<?php

namespace App\Filament\User\Resources\TestResource\Pages;

use App\Filament\User\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTest extends EditRecord
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
        ];
    }
}
