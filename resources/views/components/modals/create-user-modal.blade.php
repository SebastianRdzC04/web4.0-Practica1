<div id="registerModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 max-h-[80vh] overflow-y-auto">
            <div class=" items-center mb-4">
                <h3 class="text-lg text-center font-medium">Registre un Usuario</h3>
                <button type="button" class="text-gray-500 absolute translate-x-[385px] translate-y-[-36px] hover:text-gray-700" onclick="closeModal('registerModal')">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>

            <div>
                <h4 class="mb-2">Ingrese los datos correctamente:</h4>
                <x-forms.create-user-form />
            </div>
        </div>
    </div>
</div>
