<?php

namespace App\View\Components\Stats;

use App\Models\User;
use Illuminate\View\Component;
use App\Models\PersonalData;
use Illuminate\Support\Facades\DB;

class DoubleBarParalelaAgeStats extends Component
{
    /**
     * Los datos procesados para el gráfico de barras paralelas.
     *
     * @var array
     */
    public $data;

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
        $users = User::with('personalData')->get();


        $usersWithData = $users->filter(function($user) {
            return $user->personalData !== null;
        });

        // Contar adultos por género
        $adultsMale = $usersWithData->filter(function($user) {
            return $user->personalData->gender === 'male' && $user->personalData->age >= 18;
        })->count();

        $adultsFemale = $usersWithData->filter(function($user) {
            return $user->personalData->gender === 'female' && $user->personalData->age >= 18;
        })->count();

        // Contar menores por género
        $minorsMale = $usersWithData->filter(function($user) {
            return $user->personalData->gender === 'male' && $user->personalData->age < 18;
        })->count();

        $minorsFemale = $usersWithData->filter(function($user) {
            return $user->personalData->gender === 'female' && $user->personalData->age < 18;
        })->count();
        $data = [
            [
                "title" => "Mayores de edad",
                "data" => [
                    ["name" => "Hombres", "data" => $adultsMale, "color" => "#3b82f6"],
                    ["name" => "Mujeres", "data" => $adultsFemale, "color" => "#ec4899"],
                ],
                "total" => $adultsMale + $adultsFemale
            ],
            [
                "title" => "Menores de edad",
                "data" => [
                    ["name" => "Hombres", "data" => $minorsMale, "color" => "#3b82f6"],
                    ["name" => "Mujeres", "data" => $minorsFemale, "color" => "#ec4899"],
                ],
                "total" => $minorsMale + $minorsFemale
            ]
        ];

        return view('components.stats.double-bar-paralela-age-stats', compact('data'));
    }
}
