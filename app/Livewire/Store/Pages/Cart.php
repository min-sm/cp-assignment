<?php

namespace App\Livewire\Store\Pages;

use Livewire\Component;

class Cart extends Component
{
    public $products;

    public function mount()
    {
        $this->products = session('cart', []);
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
        if (isset($this->products[$productId])) {
            if ($this->products[$productId]['quantity'] > 1) {
                $this->products[$productId]['quantity'] -= 1;
                $this->updateCartSession();
            } else {
                $this->removeFromCart($productId);
            }
        }
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
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('store.pages.cart')->title('Cart')->extends('store.layouts.default');
    }
}
