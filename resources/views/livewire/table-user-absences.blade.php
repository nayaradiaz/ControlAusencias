<div>

    @if (session()->has('success'))
    <div id="successMessage" class="bg-green-500 text-white p-3 rounded-md mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="bg-red-500 text-white p-2 rounded mb-2">
        {{ session('error') }}
    </div>
    @endif
    <div class="p-6 bg-white shadow-md rounded-lg" wire:poll="loadAbsences">
        <h2 class="text-lg font-bold mb-4">Lista de Ausencias</h2>


        @if ($editMode)
        <div class="mb-4 p-4 border rounded bg-gray-100">
            <h3 class="font-semibold mb-2">Editar Ausencia</h3>

            <!-- Campo de Usuario -->
            <label class="block mb-2">Usuario:</label>
            <select wire:model="userId" class="w-full border rounded p-2">
                <option value="">Seleccionar Usuario</option>
                @foreach (App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('userId') <span class="text-red-500">{{ $message }}</span> @enderror

            <!-- Campo de Fecha -->
            <label class="block mt-2">Fecha:</label>
            <input type="date" wire:model="date" class="w-full border rounded p-2">
            @error('date') <span class="text-red-500">{{ $message }}</span> @enderror

            <!-- Campo de Franja Horaria -->
            <label class="block mt-2">Franja Horaria:</label>
            <select wire:model="timeSlot" class="w-full border rounded p-2">
                <option value="">Seleccionar Franja Horaria</option>
                @foreach ([
                'mañana_1' => '08:00 - 08:55',
                'mañana_2' => '08:55 - 09:50',
                'mañana_3' => '09:50 - 10:45',
                'recreo_1' => '10:45 - 11:15',
                'mañana_4' => '11:15 - 12:10',
                'mañana_5' => '12:10 - 13:05',
                'mañana_6' => '13:05 - 14:00',
                'tarde_1' => '14:00 - 14:55',
                'tarde_2' => '14:55 - 15:45',
                'tarde_3' => '15:45 - 16:45',
                'recreo_2' => '16:45 - 17:15',
                'tarde_4' => '17:15 - 18:10',
                'tarde_5' => '18:10 - 19:05',
                'tarde_6' => '19:05 - 20:00'
                ] as $slot => $hora)
                <option value="{{ $slot }}">{{ ucfirst(str_replace('_', ' ', $slot)) }} - {{ $hora }}</option>
                @endforeach
            </select>
            @error('timeSlot') <span class="text-red-500">{{ $message }}</span> @enderror

            <!-- Campo de Departamento -->
            <label class="block mt-2">Departamento:</label>
            <select wire:model="department_id" class="w-full border rounded p-2">
                <option value="">Seleccionar Departamento</option>
                @foreach ($departments as $department) <!-- Asegúrate de pasar $departments al componente -->
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            @error('department_id') <span class="text-red-500">{{ $message }}</span> @enderror

            <!-- Campo de Comentarios -->
            <label class="block mt-2">Comentarios:</label>
            <textarea wire:model="comments" class="w-full border rounded p-2"></textarea>

            <div class="mt-4">
                <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
                <button wire:click="cancelEdit" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
            </div>
        </div>
        @endif


        <table class="w-full border-collapse border border-gray-300 mt-4 text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Usuario</th>
                    <th class="border p-2">Fecha</th>
                    <th class="border p-2">Horario</th>
                    <th class="border p-2">Departamento</th>
                    <th class="border p-2">Comentarios</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absences as $absence)
                <tr class="border">
                    <td class="p-2">{{ $absence->user->name }}</td>
                    <td class="p-2">{{ $absence->date }}</td>
                    <td>
                        {{ $this->getTimeSlotLabel($absence->time_slot) }}
                    </td>
                    <td>{{ $absence->department ? $absence->department->name : 'No asignado' }}</td> <!-- Mostrar nombre del departamento -->

                    <td class="p-2">{{ $absence->comments }}</td>
                    <td class="p-2">
                        @if (\Carbon\Carbon::parse($absence->created_at)->diffInMinutes(now()) <= 10)
                            <button wire:click="edit({{ $absence->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                            <button wire:click="delete({{ $absence->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                            @else
                            <span class="text-gray-500">Tiempo expirado</span>
                            @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>