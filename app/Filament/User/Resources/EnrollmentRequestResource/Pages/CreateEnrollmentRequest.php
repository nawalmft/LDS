<?php

namespace App\Filament\User\Resources\EnrollmentRequestResource\Pages;

use App\Filament\User\Resources\EnrollmentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEnrollmentRequest extends CreateRecord
{
    protected static string $resource = EnrollmentRequestResource::class;

    public function getTitle(): string
{
    return ' إضافة طلب تسجيل';
}
}


