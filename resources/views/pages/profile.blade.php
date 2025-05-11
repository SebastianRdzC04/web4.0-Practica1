@extends('layouts.dashboard')


@section('content')
<div class="container">
    <div>
        <h2 class="text-center">Perfil del Usuario</h2>
    </div>
    <form action="">
        <div class="grid grid-cols-2 gap-10">
            <div>
                <x-common.input name="name" type="text" placeholder="Name" />
                <x-common.input name="email" type="email" placeholder="Email" />
            </div>
            <div>
                <x-common.input name="age" type="number" placeholder="Age" />
                <x-common.select-input
                    name="gender"
                    placeholder="Género"
                    :options="['Hombre' => 'Hombre', 'Mujer' => 'Mujer']"
                    selectedValue="Mujer"
                />
            </div>
        </div>
        <div class="flex justify-end w-full mt-4">
            <x-common.button-primary btnId="btn" btnText="Submit" btnType="submit" />
        </div>
    </form>


</div>
@endsection
