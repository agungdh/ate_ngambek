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
                TextEntry::make('ngambek.kapan')
                    ->label('Kapan Ngambek')
                    ->dateTime(),

                TextEntry::make('ngambek.kepada')
                    ->label('Kepada'),

                TextEntry::make('ngambek.siapa')
                    ->label('Siapa'),

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
