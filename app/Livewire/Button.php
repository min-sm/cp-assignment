<?php

namespace App\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class Button extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($product, $quantity = 1)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function render()
    {
        return view('livewire.button');
    }

    public function clicked()
    {
        $cart = session()->get('cart', []);

        $productId = $this->product->id;
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $this->quantity;
        } else {
            $cart[$productId] = [
                'id' => $this->product->id,
                'name' => $this->product->model,
                'price' => $this->product->price,
                'quantity' => $this->quantity, // input quantity
                'stock_quantity' => $this->product->stock_quantity,
                'image' => $this->product->images->first() ? asset('img/products/' . $this->product->slug . '/' . $this->product->images->first()->filename) : asset('img/common/img-unavailable.jpg'),
            ];
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);
        Debugbar::info("Cart updated:", $cart);

        $this->dispatch('cartUpdated');
    }
}
