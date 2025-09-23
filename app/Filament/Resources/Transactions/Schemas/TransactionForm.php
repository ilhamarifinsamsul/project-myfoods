<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('external_id')
                    ->required(),
                TextInput::make('checkout_link')
                    ->required(),
                FileUpload::make('barcodes_id')
                    ->label('QR Code')
                    ->image()
                    ->directory('qr_code') // direktori penyimpanan
                    ->disk('public') // disk penyimpanan
                    ->default(function ($record) {
                        return $record->barcodes->image ?? null;
                    }),
                TextInput::make('payment_method')
                    ->required()
                    ->default(null),
                TextInput::make('payment_status')
                    ->required()
                    ->default(null),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('ppn')
                    ->required()
                    ->numeric(),
                TextInput::make('total')
                    ->required()
                    ->numeric(),
            ]);
    }
}
