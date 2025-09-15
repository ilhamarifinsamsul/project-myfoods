<?php

namespace App\Filament\Resources\Barcodes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarcodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('table_number')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('qr_value')
                    ->required(),
                TextInput::make('users_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
