<form action="{{route('login')}}" method="POST">
    @csrf
    <x-common.input name="email" type="email" placeholder="Email" />
    <x-common.input name="password" type="password" placeholder="Password" />
    
    <div class="flex justify-end w-full mt-4">
        <x-common.button-primary btnId="login-btn" btnText="Iniciar Sesión" btnType="submit" />
    </div>
</form>
