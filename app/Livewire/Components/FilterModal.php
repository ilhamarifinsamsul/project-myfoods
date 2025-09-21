<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FilterModal extends Component
{
    // Initialize untuk menyimpan data filter
    public $categories;
    public $selectedCategory = [];
    public $checked = [];
    public string $title;

    // function mount untuk mengisi data awal
    public function mount($selectedCategory = []){
        $this->selectedCategory = $selectedCategory;
    }

    // Function Apply Filter
    public function applyFilter(){
        $this->dispatch('filterApplied',
        $this->selectedCategory);
    }

    // Function Reset Filter
    public function resetFilter(){
        $this->dispatch('filterApplied', []);
    }
    public function render()
    {
        return view('livewire.filter-modal', [
            'selectedCategory' => $this->selectedCategory,
        ]);
    }
}
