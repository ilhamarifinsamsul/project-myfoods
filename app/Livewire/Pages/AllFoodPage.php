<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\CategoryFilterTrait;
use App\Models\Category;
use App\Models\Foods;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AllFoodPage extends Component
{
    // filter trait to handle category filtering
    use CategoryFilterTrait;

    // deklarasi variabel
    public $categories;
    // ketika kategori dipilih, maka akan disimpan di array ini
    public $selectedCategory = [];
    // Untuk menyimpan semua item makanan
    public $items;
    public $title = "All Foods";

    // function to mount the component and initialize categories and items
    public function mount(Foods $foods)
    {
        // mengambil semua kategori dari database
        $this->categories = Category::all();
        // mengambil semua makanan sesuai dengan kategori yang dipilih
        $this->items = $foods->getAllFoods();
    }

    // Layout for the component
    #[Layout('components.layouts.page')]
    public function render()
    {
        $filteredProducts = $this->getFIlteredItems();
        return view('product.all-food', [
            'filteredProducts' => $filteredProducts,
        ]);
    }
}
