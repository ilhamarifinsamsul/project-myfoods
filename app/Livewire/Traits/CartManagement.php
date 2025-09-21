<?php

namespace App\Livewire\Traits;

trait CartManagement {
    // function incrementQuantity
    public function increment($index) {
        $this->cartItems[$index]['quantity']++;
        $this->hasUnpaidTransaction = false;
        $this->updateTotals();
    }

    // function decrementQuantity
    public function decrement($index) {
        if ($this->cartItems[$index]['quantity'] > 1) {
            $this->cartItems[$index]['quantity']--;
        }
        $this->hasUnpaidTransaction = false;
        $this->updateTotals();
    }

    // function updateTotals
    public function updateTotals(){
        $this->subtotal = array_sum(array_map(function($item) {
            return $item['is_promo'] ? $item['price_afterdiscount']: $item['price'];
            return $price * $item['quantity'];
        }, $this->cartItems));

        $this->tax = $this->subtotal * 0.11; // Assuming a 10% tax rate
        $this->total = $this->subtotal + $this->tax;
    }
}



?>
