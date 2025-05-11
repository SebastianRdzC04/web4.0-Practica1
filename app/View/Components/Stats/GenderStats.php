<?php

namespace App\View\Components\Stats;

use Illuminate\View\Component;
use App\Models\PersonalData;
use Illuminate\Support\Facades\DB;

class GenderStats extends Component
{
    /**
     * Los datos de género procesados para el gráfico.
     *
     * @var array
     */
    public $genderData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // Consultar a la base de datos y obtener conteo de usuarios por género
        $genderCounts = PersonalData::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get()
            ->keyBy('gender')
            ->toArray();

        // Preparar datos para el gráfico con formato esperado
        $data = [
            [
                'name' => 'Hombres',
                'data' => $genderCounts['male']['total'] ?? 0,
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Mujeres',
                'data' => $genderCounts['female']['total'] ?? 0,
                'color' => '#ec4899'
            ]
        ];




        return view('components.stats.gender-stats', compact('data'));
    }
}
