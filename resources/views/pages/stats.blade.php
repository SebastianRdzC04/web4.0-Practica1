@extends('layouts.dashboard')

@section('content')
    <x-common.title>GRAFICAS Y ESTADISTICAS</x-common.title>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-4">
            <x-stats.gender-stats />
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <x-stats.double-bar-age-stats />
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <x-stats.age-stats />
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <x-stats.double-bar-paralela-age-stats />
        </div>
    </div>
@endsection
