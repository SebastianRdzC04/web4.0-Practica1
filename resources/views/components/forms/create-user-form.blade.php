<form action="{{route('users.create')}}" method="POST">
    @csrf
    <x-common.input name="name" type="text" title="Name" placeholder="Name" />
    <x-common.input name="email" type="email" title="Email" placeholder="Email" />
    <x-common.input name="password" type="password" title="Password" placeholder="Password" />
    <x-common.input name="password_confirmation" type="password"  title="Confirm Password" placeholder="Password" />
    <x-common.input name="age" type="number" title="Edad" placeholder="Age" />
    <x-common.select-input
        name="gender"
        placeholder="Género"
        :options="['Hombre' => 'Hombre', 'Mujer' => 'Mujer']"
    />
    <div class="flex justify-end w-full mt-4">
        <x-common.button-primary btnId="btn" btnText="Submit" btnType="submit" />
    </div>
</form>
