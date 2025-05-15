<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $placeholder;
    public $title;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type, $placeholder, $title, $value = null)
    {
        //
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->title = $title;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.common.input');
    }
}
