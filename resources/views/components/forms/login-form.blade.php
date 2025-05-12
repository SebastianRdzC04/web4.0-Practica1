<form action="{{route('auth.login')}}" method="POST">
    @csrf
    <x-common.input name="email" type="email" title="Email" placeholder="Email" />
    <x-common.input name="password" type="password" title="Password" placeholder="Password" />

    <div class="flex justify-end w-full mt-4">
        <x-common.button-primary btnId="login-btn" btnText="Iniciar Sesión" btnType="submit" />
    </div>
</form>
