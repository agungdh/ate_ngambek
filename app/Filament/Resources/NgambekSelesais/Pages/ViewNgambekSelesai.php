<?php

namespace App\Filament\Resources\NgambekSelesais\Pages;

use App\Filament\Resources\NgambekSelesais\NgambekSelesaiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewNgambekSelesai extends ViewRecord
{
    protected static string $resource = NgambekSelesaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
