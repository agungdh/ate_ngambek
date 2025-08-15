<?php

namespace App\Filament\Resources\Ngambeks\Pages;

use App\Filament\Resources\Ngambeks\NgambekResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNgambek extends EditRecord
{
    protected static string $resource = NgambekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
