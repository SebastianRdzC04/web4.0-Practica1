<?php

namespace App\View\Components\Charts;

use Illuminate\View\Component;

class BarChart extends Component
{
    /**
     * Los datos que se mostrarán en el gráfico.
     *
     * @var array
     */
    public $datos;
    public $titulo;

    /**
     * Create a new component instance.
     *
     * @param array $datos Datos para mostrar en el gráfico de barras
     * @return void
     */
    public function __construct($datos = null, $titulo = null)
    {
        $this->datos = $datos;
        $this->titulo = $titulo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.charts.bar-chart');
    }
}
