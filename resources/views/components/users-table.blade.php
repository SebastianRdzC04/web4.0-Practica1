
<div>
    <div class="text-xl font-bold mb-4">
        Lista de Pacientes
    </div>
    <div>
        @if (isset($users) && count($users) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edad:</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexo:</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$user->name ?? 'Sin nombre'}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->email ?? 'Sin correo' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->personalData->age ?? 'Sin edad' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->personalData->gender ?? 'Sin sexo' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Agregamos los enlaces de paginación -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-10">
                <div class="flex justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <p class="text-lg font-medium">No hay pacientes registrados</p>
                <p class="text-sm text-gray-500 mb-4">Cuando se agreguen pacientes, aparecerán aquí.</p>
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Registrar nuevo paciente
                </button>
            </div>
        @endif
    </div>
</div>
