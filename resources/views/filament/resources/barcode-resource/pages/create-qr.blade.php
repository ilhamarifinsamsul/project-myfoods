<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Table Number Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Table Number</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Generated table number for QR code</p>
                </div>
                <x-filament::button
                    wire:click="regenerateTableNumber"
                    color="secondary"
                    size="sm"
                    icon="heroicon-o-arrow-path"
                >
                    Generate New
                </x-filament::button>
            </div>

            <div class="text-2xl font-bold text-center py-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                {{ $this->table_number }}
            </div>
        </div>

        {{-- QR Code Preview Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 text-center">QR Code Preview</h3>

            <div class="flex flex-col items-center space-y-4">
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="text-center mb-4">
                        <h4 class="text-md font-semibold text-gray-800">Table: {{ $this->table_number }}</h4>
                        <p class="text-sm text-gray-600">Scan QR code to access this table</p>
                    </div>

                    <div class="flex justify-center">
                        {!! QrCode::size(200)->margin(1)->generate(url($this->table_number)) !!}
                    </div>
                </div>

                <x-filament::button
                    wire:click="create"
                    color="primary"
                    size="lg"
                    icon="heroicon-o-check"
                >
                    Save QR Code
                </x-filament::button>
            </div>
        </div>
    </div>
</x-filament-panels::page>
