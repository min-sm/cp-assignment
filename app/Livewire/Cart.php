<?php

namespace App\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Livewire\Attributes\Layout; // Required for layout definition

#[Layout('layouts.default')] // Tells Livewire to use this layout
class Cart extends Component
{
    public $products;

    public function mount()
    {
        $cart = session('cart', []);
        $this->products = $cart;
        Debugbar::info($cart, $this->products);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
