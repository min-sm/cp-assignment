<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class FilterLink extends Component
{
    public $type;
    public $id;
    public $label;

    public function mount($type, $id, $label)
    {
        $this->type = $type;
        $this->id = $id;
        $this->label = $label;

        logger("FilterLink mounted with type: {$type}, id: {$id}, label: {$label}");
    }

    public function setFilterSession()
    {
        if ($this->type === 'category') {
            Session::flash('category_id', $this->id);
            return redirect()->route('products');
        } elseif ($this->type === 'brand') {
            Session::flash('brand_id', $this->id);
            return redirect()->route('products');
        }

        $this->emit('filterUpdated');
    }

    public function render()
    {
        return view('livewire.filter-link');
    }
}
