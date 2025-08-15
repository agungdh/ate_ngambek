<?php

namespace App\Filament\Resources\Ngambeks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NgambekForm
{
    /**
     * @throws \Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('kapan')->required(),
                Textarea::make('kenapa')->required(),
                TextInput::make('siapa')->nullable(),
            ]);
    }
}
