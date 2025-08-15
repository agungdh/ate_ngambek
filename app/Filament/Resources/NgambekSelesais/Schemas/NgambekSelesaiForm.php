<?php

namespace App\Filament\Resources\NgambekSelesais\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NgambekSelesaiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ngambek_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('kapan')
                    ->required(),
                TextInput::make('gimana')
                    ->required(),
            ]);
    }
}
