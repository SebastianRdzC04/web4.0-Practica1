<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class SelectInput extends Component
{
    public $name;
    public $placeholder;
    public $options;
    public $selectedValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $placeholder, $options, $selectedValue = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->options = $options;
        $this->selectedValue = $selectedValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.common.select-input');
    }
}
