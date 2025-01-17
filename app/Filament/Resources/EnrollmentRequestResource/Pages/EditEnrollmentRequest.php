<?php

namespace App\Filament\Resources\EnrollmentRequestResource\Pages;

use App\Filament\Resources\EnrollmentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnrollmentRequest extends EditRecord
{
    protected static string $resource = EnrollmentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('حذف'),
        ];
    }

    public function getTitle(): string
    {
        return 'تعديل '. '' . $this->record->user->name . ' ' . $this->record->course->name;
    }
}
