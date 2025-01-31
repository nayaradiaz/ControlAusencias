<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Ausencias</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-[#F5F5F5]">

    <div class="relative min-h-screen flex flex-col items-center justify-between selection:bg-[#FF6F61] selection:text-white">

        <!-- Header -->
        <header class="bg-[#4A90E2] text-white w-full py-6 md:py-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
                <!-- Logo -->
                <div class="flex justify-center">
                    <h1 class="text-xl font-semibold text-wrap">Control de Ausencias</h1>
                </div>
                <!-- Navigation -->
                @if (Route::has('login'))
                <livewire:welcome.navigation />
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="mt-8 w-full max-w-7xl px-4 sm:px-6 lg:px-8 flex-grow items-center flex">
            <div class="grid gap-8 sm:grid-cols-2  divide-y-4 divide-y-reverse divide-red-400">
                <!-- Project Description Section -->
                <section class="p-4 text-center">
                    <h3 class="text-2xl font-semibold text-[#4A90E2]">Descripción del Proyecto</h3>
                    <p class="mt-4 text-lg text-gray-700">Este proyecto tiene como objetivo proporcionar herramientas para que los docentes puedan gestionar y controlar sus ausencias de manera eficiente.</p>
                </section>
                <!-- Card 1: Teacher's Resources -->
                <a href="https://www.teacherspayteachers.com" class="flex flex-col items-center gap-4 rounded-lg bg-white p-6 shadow-xl ring-1 ring-gray-300 hover:bg-[#ffffffd5]  hover:text-white transition duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-center bg-[#FF6F61]/10 rounded-full p-4">
                        <svg class="w-12 h-12 text-[#FF6F61]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path d="M14 0C13.4 0 13 0.4 13 1V7H9V1C9 0.4 8.6 0 8 0C7.4 0 7 0.4 7 1V7H4C3.4 7 3 7.4 3 8C3 8.6 3.4 9 4 9H7V21H4C3.4 21 3 21.4 3 22C3 22.6 3.4 23 4 23H20C20.6 23 21 22.6 21 22C21 21.4 20.6 21 20 21H17V9H20C20.6 9 21 8.6 21 8C21 7.4 20.6 7 20 7H17V1C17 0.4 16.6 0 16 0C15.4 0 15 0.4 15 1V7H14V1C14 0.4 13.6 0 14 0Z" fill="#FF6F61" />
                        </svg>
                    </div>
                    <div class="pt-3 text-center">
                        <h2 class="text-2xl font-bold text-gray-800">Teacher's Pay Teachers</h2>
                        <p class="mt-4 text-sm text-gray-600">Buy and sell original teaching materials. Share and learn with other educators!</p>
                    </div>
                </a>

                <!-- Card 2: Edutopia -->
                <a href="https://www.edutopia.org" class="flex flex-col items-center gap-4 rounded-lg bg-white p-6 shadow-xl ring-1 ring-gray-300 hover:bg-[#ffffffd5] hover:text-white transition duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-center bg-[#FF6F61]/10 rounded-full p-4">
                        <svg class="w-12 h-12 text-[#FF6F61]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path d="M5 16L3 18L9 18L9 6L3 6L5 8L9 8L9 16Z" fill="#FF6F61" />
                        </svg>
                    </div>
                    <div class="pt-3 text-center">
                        <h2 class="text-2xl font-bold text-gray-800">Edutopia</h2>
                        <p class="mt-4 text-sm text-gray-600">Best practices, strategies, and tools to create impactful classrooms. Learn and grow with us!</p>
                    </div>
                </a>
            </div>

        </main>

        <!-- Footer -->
        <footer class="bg-[#4A90E2] text-white py-6 mt-8 w-full">
            <div class="max-w-7xl mx-auto text-center">
                <p class="text-sm">
                    <strong>Creado por Alumna de 2º DAW</strong><br>
                    &copy; 2025 Todos los derechos reservados.
                </p>
            </div>
        </footer>
    </div>

</body>

</html>