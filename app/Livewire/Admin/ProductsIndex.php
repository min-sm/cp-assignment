<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ProductsIndex extends Component
{
    #[Layout('admin.layouts.default')]
    public function render()
    {
        return view('admin.products.index');
    }
}
