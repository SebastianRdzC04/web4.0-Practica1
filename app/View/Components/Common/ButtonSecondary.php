<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class ButtonSecondary extends Component
{
    public string $btnId;
    public string $btnText;
    public string $btnType;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $btnId, string $btnText, string $btnType = 'button')
    {
        //
        $this->btnId = $btnId;
        $this->btnText = $btnText;
        $this->btnType = $btnType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.common.button-secondary');
    }
}
