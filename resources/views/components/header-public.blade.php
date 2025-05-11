<header class="w-full bg-gray-800 text-white shadow-lg">
    <div class="w-full px-4 sm:px-6 md:px-8 py-2">
        <div class="flex items-center justify-between">
            <div>
                <a href="/" class="text-xl font-bold text-white">
                    Primera Practica
                </a>
            </div>
            <div>
                @auth
                    <x-common.button-secondary btnId="btn-login" btnText="Iniciar Sesion" />

                @else
                    <x-user-dropdown />

                @endauth
            </div>
        </div>
    </div>
</header>
