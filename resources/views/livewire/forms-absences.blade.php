<div>
    <h2 class="text-center text-2xl font-semibold mt-4 ">Registrar Ausencias</h2>
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <form wire:submit.prevent="store">

            <!-- Usuario -->
            <div class="mb-4">
                <label for="userId" class="block text-gray-700 font-bold mb-2">Seleccionar Usuario</label>
                <select wire:model="userId" id="userId" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">Seleccionar Usuario</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('userId') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="department_id" class="block text-gray-700 font-bold mb-2">Departamento</label>
                <select wire:model="department_id" id="department_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">Seleccione un departamento</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>



            <!-- Fecha -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Seleccionar Fecha</label>
                <input type="date" wire:model="date" id="date" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                @error('date') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Franja Horaria -->
            <div class="mb-4">
                <label for="timeSlot" class="block text-gray-700 font-bold mb-2">Franja Horaria</label>
                <select wire:model="timeSlot" id="timeSlot" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="" >Seleccionar Franja Horaria</option>
                    @foreach ($this->getTimeSlots() as $slot => $hora)
                    <option value="{{ $slot }}">{{ ucfirst(str_replace('_', ' ', $slot)) }} - {{ $hora }}</option>
                    @endforeach
                </select>
                @error('timeSlot') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Mostrar Hora del Turno -->
            @if ($turnoHora)
            <div class="mb-4 text-blue-600 font-semibold">
                📌 Hora del turno seleccionado: {{ $turnoHora }}
            </div>
            @endif

            <!-- Comentarios -->
            <div class="mb-4">
                <label for="comments" class="block text-gray-700 font-bold mb-2">Comentarios (Opcional)</label>
                <textarea wire:model="comments" id="comments" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"></textarea>
                @error('comments') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Botón -->
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition">
                Registrar Ausencia
            </button>

            <!-- Mensaje de éxito -->
            @if (session()->has('message'))
            <p class="mt-4 text-green-600">{{ session('message') }}</p>
            @endif
        </form>
    </div>
    <br>
</div>