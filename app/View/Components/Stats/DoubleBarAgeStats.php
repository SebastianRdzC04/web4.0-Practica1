<?php

namespace App\View\Components\Stats;

use Illuminate\View\Component;
use App\Models\PersonalData;
use Illuminate\Support\Facades\DB;

class DoubleBarAgeStats extends Component
{
    /**
     * Los datos procesados para el gráfico de barras doble.
     *
     * @var array
     */
    public $ageData;

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
        $adultsMale = PersonalData::where('gender', 'male')
            ->where('age', '>=', 18)
            ->count();

        $adultsFemale = PersonalData::where('gender', 'female')
            ->where('age', '>=', 18)
            ->count();

        $minorsMale = PersonalData::where('gender', 'male')
            ->where('age', '<', 18)
            ->count();

        $minorsFemale = PersonalData::where('gender', 'female')
            ->where('age', '<', 18)
            ->count();

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


        return view('components.stats.double-bar-age-stats', compact('data'));
    }

}
