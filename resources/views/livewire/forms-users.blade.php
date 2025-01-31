<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg">
    <!-- Mostrar mensajes de error en la parte superior -->
    @if($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Mostrar mensajes de éxito en la parte superior -->
    @if(session()->has('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
    @endif
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Registrar Profesor</h2>



    <!-- Contenedor con dos columnas para dispositivos de escritorio -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Formulario de registro de profesor -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form wire:submit.prevent="registerUser">
                <!-- Campo de nombre -->
                <input type="text" wire:model="name" placeholder="Nombre" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <!-- Campo de apellidos -->
                <input type="text" wire:model="surnames" placeholder="Apellidos" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <!-- Campo de correo electrónico -->
                <input type="email" wire:model="email" placeholder="Correo electrónico" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <!-- Select para departamento -->
                <select wire:model="department_id" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccione un departamento</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>

                <!-- Botón de submit -->
                <button type="submit" class="w-full p-3 mt-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Registrar</button>
            </form>

        </div>

        <!-- Formulario de carga de CSV -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form wire:submit.prevent="uploadCsv" enctype="multipart/form-data">
                <div class="mb-6">
                    <label for="csv_file" class="block text-lg font-medium text-gray-700">Subir archivo CSV:</label>
                    <input type="file" id="csv_file" wire:model="csv_file" accept=".csv" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full p-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Subir Archivo
                </button>
            </form>


        </div>

    </div> <!-- Fin del grid -->

</div>