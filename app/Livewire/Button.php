<?php

namespace App\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class Button extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
        Debugbar::info("Product mounted:", $this->product);
    }

    public function render()
    {
        return view('livewire.button');
    }

    public function clicked()
    {
        Debugbar::info("clicked");
        Debugbar::info("Product in cart:", $this->product);
        // $this->emit('cartUpdated');
    }
}
