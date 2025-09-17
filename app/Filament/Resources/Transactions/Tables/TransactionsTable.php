<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use App\Models\TransactionItems;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Transaction Code')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Customer Name')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable(),
                ImageColumn::make('barcodes.image')
                    ->label('Barcode'),
                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->color([
                        'success' => fn ($state): bool => in_array($state, ['SUCCESS','PAID', 'SETTLED']),
                        'warning' => fn ($state): bool => $state === 'PENDING',
                        'danger' => fn ($state): bool => in_array($state, ['FAILED','EXPIRED','CANCELLED']),
                    ])
                    ->searchable(),
                TextColumn::make('external_id')
                    ->searchable(),
                TextColumn::make('checkout_link')
                    ->searchable(),

                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->money('IDR'),
                TextColumn::make('ppn')
                    ->label('PPN')
                    ->numeric()
                    ->money('IDR'),
                TextColumn::make('total')
                    ->label('Total')
                    ->numeric()
                    ->money('IDR'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('See Transaction')
                ->url(fn ($record): string => \App\Filament\Resources\TransactionItems\Pages\ListTransactionItems::getUrl([
                    'parent' => $record->id
                ])
                )
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
