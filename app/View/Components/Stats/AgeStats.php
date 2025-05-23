<?php

namespace App\View\Components\Stats;

use App\Models\PersonalData;
use App\Models\User;
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
        // Obtener usuarios activos con sus datos personales
        $users = User::with('personalData')->get();

        // Filtrar usuarios que tienen datos personales
        $usersWithData = $users->filter(function($user) {
            return $user->personalData !== null;
        });

        // Contar por edad
        $menores = $usersWithData->filter(function($user) {
            return $user->personalData->age < 18;
        })->count();

        $mayores = $usersWithData->filter(function($user) {
            return $user->personalData->age >= 18;
        })->count();

        // Preparar datos para el gráfico con formato esperado
        $dataProcessed = [
            [
                'name' => 'Menores de 18 años',
                'data' => $menores,
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Mayores de 18 años',
                'data' => $mayores,
                'color' => '#ec4899'
            ]
        ];

        return view('components.stats.age-stats', compact('dataProcessed'));
    }
}
