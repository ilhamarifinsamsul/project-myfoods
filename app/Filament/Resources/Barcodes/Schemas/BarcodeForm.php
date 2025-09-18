<?php

namespace App\Filament\Resources\Barcodes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarcodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('table_number')
                    ->required()
                    ->disabled()
                    ->default(fn() => strtoupper(chr(rand(65, 90))).rand(1000, 9999)),
                Select::make('users_id')
                    ->required()
                    ->relationship('users','name'),
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }




}
