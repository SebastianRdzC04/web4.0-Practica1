<?php

namespace App\View\Components\Stats;

use App\Models\User;
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
        // Obtener usuarios activos con sus datos personales
        $users = User::with('personalData')->get();

        // Filtrar usuarios que tienen datos personales
        $usersWithData = $users->filter(function($user) {
            return $user->personalData !== null;
        });

        // Contar por género
        $maleCount = $usersWithData->filter(function($user) {
            return $user->personalData->gender === 'male';
        })->count();

        $femaleCount = $usersWithData->filter(function($user) {
            return $user->personalData->gender === 'female';
        })->count();

        // Preparar datos para el gráfico con formato esperado
        $data = [
            [
                'name' => 'Hombres',
                'data' => $maleCount,
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Mujeres',
                'data' => $femaleCount,
                'color' => '#ec4899'
            ]
        ];

        return view('components.stats.gender-stats', compact('data'));
    }
}
