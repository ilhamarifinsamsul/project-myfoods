<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\QRController;
use App\Http\Middleware\CheckTableNumber;
use App\Livewire\Pages\AllFoodPage;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CheckoutPage;
use App\Livewire\Pages\DetailPage;
use App\Livewire\Pages\FavoritePage;
use App\Livewire\Pages\PromoPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\PaymentFailurePage;
use App\Livewire\Pages\PaymentSuccessPage;
use App\Livewire\Pages\ScanPage;
use Livewire\Livewire;

use Illuminate\Support\Facades\Route;

Route::middleware(CheckTableNumber::class)->group(function() {
    // Beranda / Home
    Route::get('/', HomePage::class)->name('home');
    // Semua Makanan / All Food
    Route::get('/food', AllFoodPage::class)->name('product.index');
    // Faviorit / Favorite Food
    Route::get('/food/favorite', FavoritePage::class)->name('product.favorite');
    // Makanan Promo / Promo Food
    Route::get('/food/promo', PromoPage::class)->name('product.promo');
    // Detail Makanan / Food Detail
    Route::get('/food/{id}', DetailPage::class)->name('product.detail');
});

Route::middleware(CheckTableNumber::class)->controller(TransactionController::class)->group(function() {
    // Cart Page
    Route::get('/cart', CartPage::class)->name('payment.cart');
    // Checkout Page
    Route::get('/checkout', CheckoutPage::class)->name('payment.checkout');

    // Proses Pembayaran / Payment Process
    Route::middleware('throttle:10,1')->post('/payment', 'handlePayment')->name('payment');
    Route::get('/payment', function() {
        abort(404);
    });

    // Status Pembayaran / Payment Status
    Route::get('/payment/status/{id}', 'paymentStatus')->name('payment.status');
    Route::get('/payment/success', PaymentSuccessPage::class)->name('payment.success');
    Route::get('/payment/failure', PaymentFailurePage::class)->name('payment.failure');

});

// Webhook update payment xendit
Route::post('/payment/webhook', [TransactionController::class, 'handleWebhook'])->name('payment.webhook');

// QR Code Scanner Page
Route::controller(QRController::class)->group(function() {
    Route::post('/store-qr-result', 'storeResult')->name('product.scan.store');
    Route::get('/scan', ScanPage::class)->name('product.scan');
    Route::get('/{tableNumber}', 'checkCode')->name('product.scan.table');
});



Route::get('/', function () {
    return view('welcome');
});
