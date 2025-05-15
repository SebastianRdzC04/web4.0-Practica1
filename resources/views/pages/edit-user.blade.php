@extends('layouts.dashboard')


@section('content')
    <div class="container">
        <x-common.title>PERFIL DEL USUARIO</x-common.title>

        <form action="{{route('profile.update', $user->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 gap-10">
                <div>
                    <x-common.input name="name" type="text" title="Nombre" placeholder="{{$user->name}}" />
                    <x-common.input name="email" type="email" title="Email" placeholder="{{$user->email}}" />
                </div>
                <div>
                    <x-common.input name="age" type="number" title="Edad" placeholder="{{$user->personalData->age}}" />
                    <x-common.select-input
                        name="gender"
                        placeholder="Género"
                        :options="['male' => 'Hombre', 'female' => 'Mujer']"
                        selectedValue="{{$user->personalData->gender}}"
                    />
                </div>
            </div>
            <div class="flex justify-end w-full mt-4">
                <x-common.button-primary btnId="btn" btnText="Submit" btnType="submit" />
            </div>
        </form>


    </div>
@endsection
