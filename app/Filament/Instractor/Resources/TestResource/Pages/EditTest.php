<?php

namespace App\Filament\Instractor\Resources\TestResource\Pages;

use App\Filament\Instractor\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTest extends EditRecord
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return ' تعديل اختبار '.'' . $this->record->test_type;
    }
    
    
}
