<?php

namespace App\Livewire\Layout;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class Header extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $cart = session('cart', []);
        $this->cartCount = 0;

        foreach ($cart as $item) {
            $this->cartCount += $item['quantity'];
        }
    }

    public function render()
    {
        return view('livewire.layout.header');
    }
}
