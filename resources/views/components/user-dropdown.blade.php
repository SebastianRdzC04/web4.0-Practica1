<div class="relative" id="user-dropdown">
    <button onclick="toggleDropdown()" type="button" class="flex items-center px-4 py-2 text-sm font-medium text-white hover:text-gray-300 focus:outline-none h-[42px]">
        <span>Josesito</span>
        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 text-gray-800 hidden z-10">
        <a href="{{ route('users.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
            Dashboard
        </a>
        <form method="POST" action="">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                Cerrar sesión
            </button>
        </form>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        }

        // Cerrar el menú cuando se hace clic fuera de él
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-dropdown');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if (dropdown && !dropdown.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</div>
