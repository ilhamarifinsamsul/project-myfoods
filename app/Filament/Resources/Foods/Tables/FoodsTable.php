<?php

namespace App\Filament\Resources\Foods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FoodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Food Name')
                    ->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('price_afterdiscount')
                    ->label('Price After Discount')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('percent')
                    ->label('Discount (%)')
                    ->sortable(),
                TextColumn::make('is_promo')
                    ->label('Is Promo')
                    ->sortable(),
                TextColumn::make('categories.name')
                    ->label('Category')
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
