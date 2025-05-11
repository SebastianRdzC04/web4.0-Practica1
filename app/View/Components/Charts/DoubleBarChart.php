<?php

namespace App\View\Components\Charts;

use Illuminate\View\Component;

class DoubleBarChart extends Component
{

    /**
     * Los datos procesados para el gráfico de barras doble.
     *
     * @var array
     */

    public $datos;
    /**
     * Create a new component instance.
     *
     * @param array $datos
     * @return void
     */
    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.charts.double-bar-chart');
    }
}
