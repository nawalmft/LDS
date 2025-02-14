<?php

namespace App\Filament\User\Pages\Auth;

use Filament\Pages\Auth\EditProfile as BaseEditProfile;   
use Filament\Pages\Page;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;


class EditProfile extends BaseEditProfile
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getPhoneFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getDateOfBirthFormComponent(): Component
    {
        return DatePicker::make('date_of_birth')
            ->label('تاريخ الميلاد')
            ->required()
            ->maxDate(now()->subYears(18))
            ->default(now()->subYears(18))
           ;
    }

    protected function getGenderFormComponent(): Component
    {
        return Select::make('gender')
            ->label('الجنس')
            ->required()
            ->options([
                'male' => 'ذكر',
                'female' => 'انثي',
            ]);
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->label('رقم الهاتف')
            ->tel()
            ->unique(ignoreRecord: true)
            ->startsWith('91,92,93,94,95')
            ->maxLength(9)
            ->required()
            ->maxLength(255);
    }
}