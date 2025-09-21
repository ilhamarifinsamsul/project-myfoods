<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    // Initialize untuk menyimpan data message dan type
    public $message1;
    public $message2;
    public $type = 'success'; // default type
    public $visible = false; // untuk mengontrol visibilitas toast

    // Method untuk menampilkan toast
    #[On('toast')]
    public function computed($data) {
        $this->message1 = $data['message1'] ?? 'Operation Successful';
        $this->message2 = $data['message2'] ?? '';
        $this->type = $data['type'] ?? 'success';
        $this->visible = true;

        // Sembunyikan toast setelah 3 detik
        $this->dispatchBrowserEvent('toast-shown');
        $this->dispatchBrowserEvent('toast-hide', ['timeout' => 3000]);
    }
    public function render()
    {
        return view('livewire.toast');
    }
}
