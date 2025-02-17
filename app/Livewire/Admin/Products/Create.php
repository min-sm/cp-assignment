<?php

namespace App\Livewire\Admin\Products;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Create extends Component
{

    #[Title('Create Product')]
    #[Layout('admin.layouts.default')]
    public function render()
    {
        return view('admin.products.create');
    }
}
