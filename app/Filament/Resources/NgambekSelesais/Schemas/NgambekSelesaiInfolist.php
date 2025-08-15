<?php

namespace App\Filament\Resources\NgambekSelesais\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class NgambekSelesaiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('ngambek_id')
                    ->numeric(),
                TextEntry::make('kapan')
                    ->dateTime(),
                TextEntry::make('gimana'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
