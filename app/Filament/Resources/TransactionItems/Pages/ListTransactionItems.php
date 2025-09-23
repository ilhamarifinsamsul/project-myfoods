<?php

namespace App\Filament\Resources\TransactionItems\Pages;

use App\Filament\Resources\TransactionItems\TransactionItemsResource;
use App\Filament\Traits\HasParentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransactionItems extends ListRecords
{
    use HasParentResource;
    protected static string $resource = TransactionItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
        ];
    }
}
