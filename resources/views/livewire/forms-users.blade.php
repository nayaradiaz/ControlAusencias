<div>
    <h2 class="text-center text-2xl font-semibold mt-4 ">Registrar Profesores</h2>
    <div class="max-w-xl mx-auto bg-white shadow-xl rounded-lg p-6">
        <form wire:submit.prevent="registerUser" >

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nombre</label>
                <input type="text" wire:model="name" id="name" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                @error('name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Apellidos -->
            <div class="mb-4">
                <label for="surnames" class="block text-gray-700 font-bold mb-2">Apellidos</label>
                <input type="text" wire:model="surnames" id="surnames" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                @error('surnames') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico</label>
                <input type="email" wire:model="email" id="email" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                @error('email') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Departamento -->
            <div class="mb-4">
                <label for="department_id" class="block text-gray-700 font-bold mb-2">Departamento</label>
                <select wire:model="department_id" id="department_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">Seleccionar Departamento</option>
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Botón de registro -->
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition">
                Registrar Usuario
            </button>


        </form>

        <!-- Carga de CSV -->
        <div class="mt-6">
            <form wire:submit.prevent="uploadCsv" enctype="multipart/form-data">
                <input type="file" wire:model="csv_file" class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                @error('csv_file') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror

                <button type="submit" class="w-full mt-2 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition">
                    Subir CSV
                </button>

                <!-- Mensaje de éxito -->
                @if (session()->has('success'))
                <p class="mt-4 text-green-600">{{ session('success') }}</p>
                @endif
            </form>
        </div>
    </div>
    <br>

</div>