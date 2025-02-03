<?php

namespace App\Filament\Instractor\Resources\TestQuestionResource\Pages;

use App\Filament\Instractor\Resources\TestQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestQuestion extends CreateRecord
{
    protected static string $resource = TestQuestionResource::class;

    public function getTitle(): string
    {
        return 'اضافة سؤال إختبار'; 
    }
}
