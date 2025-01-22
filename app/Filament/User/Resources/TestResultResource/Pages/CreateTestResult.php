<?php

namespace App\Filament\User\Resources\TestResultResource\Pages;

use App\Filament\User\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestResult extends CreateRecord
{
    protected static string $resource = TestResultResource::class;
}
