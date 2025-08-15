<?php

namespace App\Filament\Resources\NgambekSelesais;

use App\Filament\Resources\NgambekSelesais\Pages\CreateNgambekSelesai;
use App\Filament\Resources\NgambekSelesais\Pages\EditNgambekSelesai;
use App\Filament\Resources\NgambekSelesais\Pages\ListNgambekSelesais;
use App\Filament\Resources\NgambekSelesais\Pages\ViewNgambekSelesai;
use App\Filament\Resources\NgambekSelesais\Schemas\NgambekSelesaiForm;
use App\Filament\Resources\NgambekSelesais\Schemas\NgambekSelesaiInfolist;
use App\Filament\Resources\NgambekSelesais\Tables\NgambekSelesaisTable;
use App\Models\NgambekSelesai;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NgambekSelesaiResource extends Resource
{
    protected static ?string $model = NgambekSelesai::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return NgambekSelesaiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return NgambekSelesaiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NgambekSelesaisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNgambekSelesais::route('/'),
            'create' => CreateNgambekSelesai::route('/create'),
            'view' => ViewNgambekSelesai::route('/{record}'),
            'edit' => EditNgambekSelesai::route('/{record}/edit'),
        ];
    }
}
