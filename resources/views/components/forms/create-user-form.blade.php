<form action="{{route('users.create')}}" method="POST">
    @csrf
    <x-common.input name="name" type="text" placeholder="Name" />
    <x-common.input name="email" type="email" placeholder="Email" />
    <x-common.input name="password" type="password" placeholder="Password" />
    <x-common.input name="password_confirmation" type="password" placeholder="Confirm Password" />
    <x-common.input name="age" type="number" placeholder="Age" />
    <x-common.select-input
        name="gender"
        placeholder="Género"
        :options="['Hombre' => 'Hombre', 'Mujer' => 'Mujer']"
    />
    <div class="flex justify-end w-full mt-4">
        <x-common.button-primary btnId="btn" btnText="Submit" btnType="submit" />
    </div>
</form>
