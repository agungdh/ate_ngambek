<?php

namespace App\Filament\Resources\NgambekSelesais\Pages;

use App\Filament\Resources\NgambekSelesais\NgambekSelesaiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditNgambekSelesai extends EditRecord
{
    protected static string $resource = NgambekSelesaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
