<?php

namespace App\Filament\Resources\EnrollmentResource\Pages;

use App\Filament\Resources\EnrollmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateEnrollment extends CreateRecord
{
    protected static string $resource = EnrollmentResource::class;
     
    public function getTitle(): string
    {
        return ' تسجيل';
        
    } 
}
