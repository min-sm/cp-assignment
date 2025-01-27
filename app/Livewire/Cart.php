<?php

namespace App\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
// use Livewire\Attributes\Layout;

// #[Layout('layouts.default')]
class Cart extends Component
{
    public $products;

    public function mount()
    {
        $this->products = session('cart', []);
        Debugbar::info($this->products);
    }

    public function increaseQuantity($productId)
    {
        if (isset($this->products[$productId])) {
            $this->products[$productId]['quantity'] += 1;
            $this->updateCartSession();
        }
    }

    public function decreaseQuantity($productId)
    {
        Debugbar::info("Entered decreaseQuantity");
        // if (isset($this->products[$productId])) {
        //     if ($this->products[$productId]['quantity'] > 1) {
        //         $this->products[$productId]['quantity'] -= 1;
        //         $this->updateCartSession();
        //     } else {
        //         $this->removeFromCart($productId);
        //     }
        // }
    }

    public function removeFromCart($productId)
    {
        if (isset($this->products[$productId])) {
            unset($this->products[$productId]);
            $this->updateCartSession();
        }
    }

    private function updateCartSession()
    {
        // Update the session with the new cart data
        session(['cart' => $this->products]);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
