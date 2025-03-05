<?php

namespace App\Livewire\Components\Form;

use App\Models\Serie;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Attributes\On;
use Livewire\Component;

class SelectDropdown extends Component
{
    public $name;
    public $options;
    public $required = false;
    public $attributesForParentDiv = '';
    public $attributesForSelect = '';
    public $selectDisableCondition = false;
    public $conditionForLastOption = true;
    public $jsCodeForChangeEvent = '';
    public $model;

    public function mount($name, $options, $required = false, $attributesForParentDiv = '', $attributesForSelect = '', $selectDisableCondition = false, $conditionForLastOption = true, $jsCodeForChangeEvent = '')
    {
        $this->name = $name;
        $this->options = $options;
        $this->required = $required;
        $this->attributesForParentDiv = $attributesForParentDiv;
        $this->attributesForSelect = $attributesForSelect;
        $this->selectDisableCondition = $selectDisableCondition;
        $this->conditionForLastOption = $conditionForLastOption;
        $this->jsCodeForChangeEvent = $jsCodeForChangeEvent;

        Debugbar::info($this->selectDisableCondition);
    }

    public function updatedModel($value)
    {
        if ($this->name == "brand") {
            if (is_numeric($value)) {
                $this->dispatch('updateFilteredSeries', filteredSeries: Serie::where('brand_id', $value)->get());
            } else {
                $this->dispatch('updateFilteredSeries', filteredSeries: []);
            }
        }
    }

    #[On('updateFilteredSeries')]
    public function updateFilteredSeries($filteredSeries)
    {
        Debugbar::info("Filtered Series Updated: ", $filteredSeries);

        if ($this->name == "series") {
            $this->options = $filteredSeries;
            if (!empty($filteredSeries)) {
                $this->selectDisableCondition = false;
                $this->conditionForLastOption = true;
            } else {
                $this->selectDisableCondition = true;
                $this->conditionForLastOption = false;
            }
        }
    }

    public function render()
    {
        return view('components.form.select-dropdown');
    }
}
