<?php

namespace App\Filament\Resources\Ngambeks;

use App\Filament\Resources\Ngambeks\Pages\CreateNgambek;
use App\Filament\Resources\Ngambeks\Pages\EditNgambek;
use App\Filament\Resources\Ngambeks\Pages\ListNgambeks;
use App\Filament\Resources\Ngambeks\Schemas\NgambekForm;
use App\Filament\Resources\Ngambeks\Tables\NgambeksTable;
use App\Models\Ngambek;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NgambekResource extends Resource
{
    protected static ?string $model = Ngambek::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'kenapa';

    /**
     * @throws \Exception
     */
    public static function form(Schema $schema): Schema
    {
        return NgambekForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NgambeksTable::configure($table);
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
            'index' => ListNgambeks::route('/'),
            'create' => CreateNgambek::route('/create'),
            'edit' => EditNgambek::route('/{record}/edit'),
        ];
    }
}
