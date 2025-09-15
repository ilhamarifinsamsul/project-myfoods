<?php

namespace App\Filament\Resources\Foods\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FoodsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('price_afterdiscount')
                    ->default(null),
                TextInput::make('percent')
                    ->default(null),
                TextInput::make('is_promo')
                    ->default(null),
                TextInput::make('categories_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
