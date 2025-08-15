<?php

namespace App\Filament\Resources\Ngambeks\Pages;

use App\Filament\Resources\Ngambeks\NgambekResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewNgambek extends ViewRecord
{
    protected static string $resource = NgambekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
