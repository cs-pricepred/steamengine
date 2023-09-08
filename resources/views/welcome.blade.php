<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CS Price Prediction</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased bg-neutral-900 w-full h-full font-display text-neutral-100">
        <div class="absolute top-0 left-0 right-0 bottom-0 bg-infernob bg-cover opacity-60 mix-blend-hard-light -z-10"></div>
        <div class="absolute top-4 right-8">
            @if (Route::has('login'))
                <div class="flex gap-8">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hover:text-900 dark:hover:text-200 hover:-skew-x-12 hover:scale-y-125">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-900 dark:hover:text-200 hover:-skew-x-12 hover:scale-y-125">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hover:text-900 dark:hover:text-200 hover:-skew-x-12 hover:scale-y-125">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <main class="h-full flex flex-col justify-center p-8">
            <h1 class="font-display font-bold text-9xl">CS Price Prediction</h1>
            <p class="font-display text-lg mt-8">The best price prediction for Counterstrike Items.</p>
        </main>

    </body>
</html>
