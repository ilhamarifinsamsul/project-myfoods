<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Validate;
use Livewire\Attributes\Session;
use Livewire\Component;

class CustomerModal extends Component
{
    // Validation rules
    #[Validate('required', message: 'Name is required')]
    #[Session('name')]
    public $name;

    #[Validate('required|min:10', message: 'Phone number is required and must be at least 10 digits')]
    #[Session('phone')]
    public $phone;

    // Function mount
    public function mount(){
        $this->name = session('name', '');
        $this->phone = session('phone', '');
    }

    // Function save user
    public function saveUserInfo(){
        if (str_starts_with($this->phone, '08')) {
            $this->phone = '62' . substr($this->phone, 1);
        } elseif (str_starts_with($this->phone, '8')) {
            $this->phone = '62' . $this->phone;
        }

        // validate user phone number
        $this->validate();
        session(['name' => $this->name, 'phone' => $this->phone]);
        $this->dispatch('save-user-modal');
    }

    public function render()
    {
        return view('livewire.customer-modal');
    }
}
