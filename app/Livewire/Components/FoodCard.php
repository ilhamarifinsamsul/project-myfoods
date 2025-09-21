<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FoodCard extends Component
{
    // Initialize untuk menyimpan data filter
    public $categories;
    public $matchedCategory;
    public $data;
    public bool $isGrid = true;

    // function mount untuk mengisi data awal
    public function mount(){
        $this->matchedCategory = collect($this->categories)->firstWhere('id', $this->data->categories_id);
    }

    // function show detail food
    public function showDetails(){
        return $this->redirect('/food/' . $this->data->id, navigate: true);
    }

    public function render()
    {
        return view('livewire.food-card');
    }
}
