<?php

namespace App\Filament\Instractor\Resources\TestResultResource\Pages;

use App\Filament\Instractor\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestResult extends EditRecord
{
    protected static string $resource = TestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return ' تعديل  نتيجة اختبار '.'' . $this->record->user->name;
    }
}
