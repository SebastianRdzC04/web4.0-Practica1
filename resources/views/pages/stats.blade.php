@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">GRÁFICAS ESTADÍSTICAS</h2>
    </div>
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
    </div>
@endsection
