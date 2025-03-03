<?php

namespace App\Livewire\Admin\Products;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public $slug;

    #[Layout('admin.layouts.default')]

    public function render()
    {
        return view('admin.products.edit');
    }
}
