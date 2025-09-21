<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\CartManagement;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Session;

use function Termwind\ask;

class CartPage extends Component
{
    use CartManagement;

    // initialize $foods
    public $foods;
    public $title = 'All Foods';

    public bool $selectAll = true;

    public $selectedItems = [];

    // seesion Livewire
    #[Session(key: 'cart_items')]
    public $cartItems = [];
    #[Session(key: 'has_unpaid_transaction')]
    public $hasUnpaidTransaction;

    // function mount
    public function mount()
    {
        $this->updateSelectedItems();
    }

    // function updatedSelectAll
    public function updatedSelectAll()
    {
        foreach ($this->cartItems as &$item) {
            $item['selected'] = $this->selectAll;
        }
        $this->updateSelectedItems();
    }

    // function updateSelectedItems
    public function updateSelectedItems()
    {
        $this->selectedItems = collect($this->cartItems)->filter(fn ($item) => $item['selected'])->toArray();

        $this->selectAll = count($this->selectedItems) === count($this->cartItems);

        session(['has_unpaid_transaction' => false]);
    }

    // function deleteSelected
    public function deleteSelected()
    {
        $this->cartItems = collect($this->cartItems)->filter(fn ($item) => !$item['seelected'])->toArray();

        $selectedId = collect($this->selectedItems)->map(fn ($item) => $item['id'])->toArray();

        $cartItemIds = collect(session('cart_items', []))
        ->map(fn ($item) => $item['id'])->toArray();

        $cartItemIds = array_diff($cartItemIds, $selectedId);

        session(['cart_items' => $cartItemIds]);

        $this->selectedItems = [];
    }

    // function checkout
    public function checkout()
    {
        if (empty($this->selectedItems))
        {
            $this->addError('selectedItems', 'Please select at least one item to proceed.');
            return;
        }

        session(['cart_items' => $this->cartItems]);
        return $this->redirect('/checkout', navigate: true);
    }

    #[Layout('components.layouts.page')]
    public function render()
    {
        return view('payment.cart');
    }
}
