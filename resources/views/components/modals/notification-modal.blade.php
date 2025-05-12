@if ($errors->any() || session('error') || session('success'))
<div id="notificationModal" class="fixed inset-0 z-50 flex items-start justify-end overflow-y-auto">
    <div class="p-4 m-4 max-w-sm w-full">
        @if($errors->any() || session('error'))
        <div class="bg-white rounded-lg shadow-xl overflow-hidden border-l-4 border-red-500 transform transition-all animate-fade-in-down">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900">¡Atención! Se han detectado errores:</p>
                        <ul class="mt-2 text-sm text-red-600 list-disc list-inside">
                            @if(session('error'))
                                <li>{{ session('error') }}</li>
                            @endif
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button onclick="closeNotification()" class="inline-flex text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(session('success'))
        <div class="bg-white rounded-lg shadow-xl overflow-hidden border-l-4 border-green-500 transform transition-all animate-fade-in-down">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900">¡Operación exitosa!</p>
                        <p class="mt-1 text-sm text-green-600">
                            {{ session('success') }}
                        </p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button onclick="closeNotification()" class="inline-flex text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.5s ease-out forwards;
    }

    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Auto-dismiss after 10 seconds */
    #notificationModal {
        animation: fadeOut 0.5s ease-out forwards;
        animation-delay: 10s;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }
</style>

<script>
    function closeNotification() {
        document.getElementById('notificationModal').style.display = 'none';
    }
</script>
@endif
