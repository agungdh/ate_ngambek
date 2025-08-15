<?php

namespace App\Filament\Resources\NgambekSelesais\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder; // <-- tambahkan
class NgambekSelesaisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('ngambek'))
            ->columns([
                // GANTI kolom ngambek_id dengan 3 kolom dari tabel ngambek
                TextColumn::make('ngambek.kapan')
                    ->label('Kapan Ngambek')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('ngambek.kepada')
                    ->label('Kepada')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('ngambek.siapa')
                    ->label('Siapa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kapan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('gimana')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
