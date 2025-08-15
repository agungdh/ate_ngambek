<?php

namespace App\Filament\Resources\NgambekSelesais\Schemas;

use App\Models\Ngambek;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NgambekSelesaiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ngambek_id')
                    ->options(Ngambek::query()->pluck('kapan', 'id'))
                    ->searchable()
                    ->required(),
                DateTimePicker::make('kapan')
                    ->required(),
                TextInput::make('gimana')
                    ->required(),
            ]);
    }
}
