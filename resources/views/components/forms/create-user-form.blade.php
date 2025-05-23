<form action="{{route('users.create')}}" method="POST">
    @csrf
    <x-common.input name="name" type="text" title="Name" value="{{old('name') ?? null}}" placeholder="name" />
    <x-common.input name="email" type="email" title="Email" value="{{old('email') ?? null}}" placeholder="email" />
    <x-common.input name="age" type="number" title="Age" value="{{old('age') ?? null}}" placeholder="age" />

    <x-common.select-input
        name="gender"
        placeholder="Género"
        :options="['Hombre' => 'Hombre', 'Mujer' => 'Mujer']"
    />
    <div class="flex justify-end w-full mt-4">
        <x-common.button-primary btnId="btn" btnText="Submit" btnType="submit" />
    </div>
</form>
