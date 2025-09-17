<?php

namespace App\Filament\Resources\Foods\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FoodsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->directory('foods')
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp ')
                    ->reactive() // Reactive berfungsi untuk memicu perubahan pada input lain ketika input ini berubah
                    ->columnSpanFull(),
                Toggle::make('is_promo')
                    ->label('Promo?')
                    ->reactive(),
                Select::make('percent')
                    ->label('Discount (%)')
                    ->options([
                        '10' => '10%',
                        '20' => '20%',
                        '35' => '35%',
                        '50' => '50%',
                    ])
                    ->reactive()
                    ->columnSpanFull()
                    ->hidden(fn ($get) => !$get('is_promo'))
                    ->afterStateUpdated(function ($set, $get, $state) {
                        if ($get('is_promo') && $get('price')) {
                            $discount = ($get('price') * (int) $state) / 100;
                            $set('price_afterdiscount', $get('price') - $discount);
                        }
                    }),
                TextInput::make('price_afterdiscount')
                    ->label('Harga Setelah Diskon')
                    ->numeric()
                    ->prefix('Rp ')
                    ->readOnly()
                    ->columnSpanFull()
                    ->hidden(fn ($get) => !$get('is_promo')),
                Select::make('categories_id')
                    ->label('Category')
                    ->required()
                    ->columnSpanFull()
                    ->relationship('categories', 'name'),
            ]);
    }
}
