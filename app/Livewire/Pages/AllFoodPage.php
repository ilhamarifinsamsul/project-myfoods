<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\CategoryFilterTrait;
use App\Models\Category;
use App\Models\Foods;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AllFoodPage extends Component
{
    use CategoryFilterTrait;

    public $categories;
    public $selectedCategory = [];
    public $items;
    public $title = "All Foods";

    // function to mount the component and initialize categories and items
    public function mount(Foods $foods)
    {
        $this->categories = Category::all();
        $this->items = $foods->getAllFoods();
    }

    // Layout for the component
    #[Layout('components.layouts.page')]
    public function render()
    {
        $filteredProducts = $this->getFIlteredItems();
        return view('product.all-food-page', [
            'filteredProducts' => $filteredProducts,
        ]);
    }
}
