<?php

namespace App\View\Components\Stats;

use App\Models\PersonalData;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class AgeStats extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //consultar a la base de datos de cuantos son mayores y menores de 18
        $data = PersonalData::all();

        // Preparar datos para el gráfico con formato esperado
        $dataProcessed = [
            [
                'name' => 'Menores de 18 años',
                'data' => $data->where('age', '<', 18)->count(),
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Mayores de 18 años',
                'data' => $data->where('age', '>=', 18)->count(),
                'color' => '#ec4899'
            ]
        ];


        return view('components.stats.age-stats', compact('dataProcessed'));
    }
}
