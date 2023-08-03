<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RincianPembayaran as RincianPembayaranModel;

class Cart extends Component
{
    public function render()
    {
        return view('livewire.cart');
    }
}
