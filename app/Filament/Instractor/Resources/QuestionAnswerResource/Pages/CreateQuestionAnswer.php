<?php

namespace App\Filament\Instractor\Resources\QuestionAnswerResource\Pages;

use App\Filament\Instractor\Resources\QuestionAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestionAnswer extends CreateRecord
{
    protected static string $resource = QuestionAnswerResource::class;

    public function getTitle(): string
    {
        return 'اضافة  اجابة';
    }
}
