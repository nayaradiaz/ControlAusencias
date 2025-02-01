<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-center mb-4">Ausencias para {{ $date->format('l, d F Y') }} - {{ $timeSlot }}</h1>

        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Usuario</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Departamento</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Comentario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absences as $absence)
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $absence->user->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $absence->department->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $absence->comments }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between items-center mt-4">
            <button wire:click="previousDay" wire:navigate class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Anterior Día</button>
            <button wire:click="nextDay" wire:navigate class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Siguiente Día</button>
            <button wire:click="previousHour" wire:navigate class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Anterior Hora</button>
            <button wire:click="nextHour" wire:navigate class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Siguiente Hora</button>
        </div>
    </div>
</div>
