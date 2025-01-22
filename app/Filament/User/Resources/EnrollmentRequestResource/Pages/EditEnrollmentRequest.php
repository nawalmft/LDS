<?php

namespace App\Filament\User\Resources\EnrollmentRequestResource\Pages;

use App\Filament\User\Resources\EnrollmentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnrollmentRequest extends EditRecord
{
    protected static string $resource = EnrollmentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'تعديل '. '' . $this->record->user->name . ' ' . $this->record->course->name;
    }
}
