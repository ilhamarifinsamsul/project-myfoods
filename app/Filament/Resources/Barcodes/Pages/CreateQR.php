<?php

namespace App\Filament\Resources\Barcodes\Pages;

use App\Filament\Resources\Barcodes\BarcodeResource;
use Filament\Resources\Pages\Page;
use App\Models\Barcode;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CreateQR extends Page
{
    protected static string $resource = BarcodeResource::class;
    protected static ?string $title = 'Create QR Code';

    public $table_number;

    public function mount(): void
    {
        // Generate table number
        $this->table_number = strtoupper(chr(rand(65, 90)) . rand(1000, 9999));
    }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'table_number' => $this->table_number,
        ]);
    }

    public function regenerateTableNumber(): void
    {
        // Generate new table number
        $this->table_number = strtoupper(chr(rand(65, 90)) . rand(1000, 9999));

        // Show notification
        Notification::make()
            ->title('New table number generated')
            ->body('Table: ' . $this->table_number)
            ->success()
            ->send();
    }

    public function create(): void
    {
        $host = url($this->table_number);

        // Generate the QR code as an SVG image
        $svgContent = QrCode::margin(1)->size(200)->generate($host);

        // Define the file path for the SVG
        $svgFilePath = 'qr_codes/' . $this->table_number . '.svg';

        // Save the SVG content to storage
        Storage::disk('public')->put($svgFilePath, $svgContent);

        // Save to database
        Barcode::create([
            'table_number' => $this->table_number,
            'users_id' => Auth::id(),
            'image' => $svgFilePath,
            'qr_value' => $host
        ]);

        // Send success notification
        Notification::make()
            ->title('QR Code Created Successfully')
            ->body('Table number: ' . $this->table_number)
            ->success()
            ->icon('heroicon-o-check-circle')
            ->send();

        // Redirect to the barcode list
        $this->redirect($this->getResource()::getUrl('index'));
    }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return false;
    }

    public function getView(): string
    {
        return 'filament.resources.barcode-resource.pages.create-qr';
    }
}
