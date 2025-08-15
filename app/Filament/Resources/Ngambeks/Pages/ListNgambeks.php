<?php

namespace App\Filament\Resources\Ngambeks\Pages;

use App\Filament\Resources\Ngambeks\NgambekResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNgambeks extends ListRecords
{
    protected static string $resource = NgambekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
