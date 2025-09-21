<?php

namespace App\Livewire\Traits;
use Livewire\Attributes\On;

trait CategoryFilterTrait
{
    #[On('filterApplied')]
    public function applyFilter($selectedCategories)
    {
        $this->selectedCategories = $selectedCategories;
        $this->resetPage(); // Reset to the first page when filter changes
    }

    public function getFIlteredItems()
    {
        if (count($this->selectedCategories) > 0) {
            return $this->items->filter(function ($item) {
                return in_array($item->category_id, $this->selectedCategories);
            });
        }
        return $this->items;
    }
}



?>
