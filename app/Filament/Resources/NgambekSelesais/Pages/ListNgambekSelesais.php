<?php

namespace App\Filament\Resources\NgambekSelesais\Pages;

use App\Filament\Resources\NgambekSelesais\NgambekSelesaiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNgambekSelesais extends ListRecords
{
    protected static string $resource = NgambekSelesaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
