<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PageTitleNav extends Component
{
    // Initialize untuk menyimpan data title dan filter
    public string $title;
    public bool $showModal = false;
    public bool $hasBack = false;
    public bool $hasFilter = true;

    protected $listeners = ['showModal' => 'openModal'];

    // function untuk membuka modal
    public function openModal() {
        $this->showModal = true;
    }

    // function untuk menutup modal
    public function closeModal() {
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.page-title-nav');
    }
}
