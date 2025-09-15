<?php

namespace App\Filament\Resources\TransactionItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('transactions_id')
                    ->required()
                    ->numeric(),
                TextInput::make('foods_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
            ]);
    }
}
