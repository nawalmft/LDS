<?php

namespace App\Filament\Instractor\Resources\QuestionResource\Pages;

use App\Filament\Instractor\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    public function getTitle(): string
    {
        return 'اضافة سؤال '; 
    }
}
