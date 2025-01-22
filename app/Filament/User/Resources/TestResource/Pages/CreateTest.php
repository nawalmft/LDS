<?php

namespace App\Filament\User\Resources\TestResource\Pages;

use App\Filament\User\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;
}
