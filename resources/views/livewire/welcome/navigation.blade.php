<nav class=" flex flex-1 justify-center">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Ir a Panel
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class=" hover:underline-offset-8 hover:decoration-2 hover:underline  rounded-md p-3 text-white"
        >
            Iniciar Sesión
        </a>

        <!-- {{-- @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Register
            </a>
        @endif --}} -->
    @endauth
</nav>