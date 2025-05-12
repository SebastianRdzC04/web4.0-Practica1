@extends('layouts.dashboard')

@section('content')
    <x-common.title>LISTA DE USUARIOS</x-common.title>
    <div>
        <x-users-table />
    </div>

@endsection
