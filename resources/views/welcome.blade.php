<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SISES</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Tailwind CSS via CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="min-h-screen flex items-center justify-center bg-[#312C51]">

        @if (Route::has('login'))
            <div class="bg-[#48426d] p-8 rounded-lg shadow-lg flex gap-4">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="px-6 py-2 bg-white text-[#312C51] font-semibold rounded hover:bg-gray-200 transition"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="px-6 py-2 bg-white text-[#312C51] font-semibold rounded hover:bg-gray-200 transition"
                    >
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="px-6 py-2 bg-white text-[#312C51] font-semibold rounded hover:bg-gray-200 transition"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif

    </body>
</html>
