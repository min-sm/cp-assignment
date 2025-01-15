<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Header extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        // Initialize cart count from your cart service/session
        $this->cartCount = session('cart', []) ? count(session('cart')) : 0;
    }

    public function updateCartCount()
    {
        // Update cart count when cart is modified
        $this->cartCount = session('cart', []) ? count(session('cart')) : 0;
    }

    public function render()
    {
        return view('livewire.layout.header');
    }
}
