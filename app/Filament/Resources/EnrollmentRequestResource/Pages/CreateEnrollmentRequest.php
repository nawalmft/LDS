<?php

namespace App\Filament\Resources\EnrollmentRequestResource\Pages;

use App\Filament\Resources\EnrollmentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateEnrollmentRequest extends CreateRecord
{
    protected static string $resource = EnrollmentRequestResource::class;
    
    public function getTitle(): string
    {
        return 'طلب تسجيل';
    }
}
