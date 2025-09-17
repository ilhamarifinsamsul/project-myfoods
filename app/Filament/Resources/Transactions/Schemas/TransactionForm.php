<?php

namespace App\Filament\Resources\Transactions\Schemas;

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
                TextInput::make('barcodes_id')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_method')
                    ->default(null),
                TextInput::make('payment_status')
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
