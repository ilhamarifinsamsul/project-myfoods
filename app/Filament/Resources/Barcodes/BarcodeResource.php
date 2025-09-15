<?php

namespace App\Filament\Resources\Barcodes;

use App\Filament\Resources\Barcodes\Pages\CreateBarcode;
use App\Filament\Resources\Barcodes\Pages\EditBarcode;
use App\Filament\Resources\Barcodes\Pages\ListBarcodes;
use App\Filament\Resources\Barcodes\Schemas\BarcodeForm;
use App\Filament\Resources\Barcodes\Tables\BarcodesTable;
use App\Models\Barcode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BarcodeResource extends Resource
{
    protected static ?string $model = Barcode::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return BarcodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarcodesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBarcodes::route('/'),
            'create' => CreateBarcode::route('/create'),
            'edit' => EditBarcode::route('/{record}/edit'),
        ];
    }
}
