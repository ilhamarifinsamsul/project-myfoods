<?php

namespace App\Livewire\Components;

use Livewire\Component;

class MenuItemList extends Component
{
    // Initialize untuk menyimpan data List
    public $items;
    public bool $withCheckbox = true;

    // function mount
    public function mount($items){
        $this->items = $items;
    }
    public function render()
    {
        return view('livewire.menu-item-list');
    }
}
