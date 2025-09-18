<?php

namespace App\Filament\Resources\Barcodes\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BarcodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('table_number')
                    ->label('Table Number')
                    ->searchable(),
                // ImageColumn::make('image'),
                TextColumn::make('qr_value')
                    ->searchable(),
                TextColumn::make('users.name')
                    ->label('User Name')
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
                // EditAction::make(),
                Action::make('download')
                ->label('Download QR Code')
                ->icon('heroicon-o-arrow-down-tray') // Fixed icon name
                ->action(function ($record) {
                    $filePath = storage_path('app/public/'. $record->image);
                    if (file_exists($filePath)) {
                        return response()->download($filePath);
                    }
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
