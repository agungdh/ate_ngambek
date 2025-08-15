<?php

namespace App\Filament\Resources\Ngambeks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class NgambekInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kapan')
                    ->dateTime(),
                TextEntry::make('kenapa'),
                TextEntry::make('siapa'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
