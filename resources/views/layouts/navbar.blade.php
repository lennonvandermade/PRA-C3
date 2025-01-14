<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Voetbal Toernooi - Infopagina</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Voeg Tailwind CSS toe via CDN -->
</head>
<body class="bg-white text-gray-900">

    <!-- Header -->
    <header class="bg-white-400 p-4" style="background-color: #00a0e4">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo Centraal in het Midden -->
            <div class="w-1/3"></div> <!-- Lege ruimte om de logo te centreren -->

            <!-- Logo -->
            <img src="{{ asset('/img/schoolvoetbal.png') }}" alt="School Voetbal Logo" class="h-40 w-65">

        <!-- Navigatielinks Gecentreerd -->
        <nav class="container mx-auto mt-8 py-16" style="background-color: #00a0e4;">
            <ul class="flex justify-center space-x-8">
                <li><a href="{{ url('/') }}" class="text-white hover:text-gray-300 font-semibold transition duration-300 transform hover:-translate-y-7">Home</a></li>
                <li><a href="{{ url('/schema') }}" class="text-white hover:text-gray-300 font-semibold transition duration-300 transform hover:-translate-y-7">Schema</a></li>
                <li><a href="{{ url('/inschrijven') }}" class="text-white hover:text-gray-300 font-semibold transition duration-300 transform hover:-translate-y-7">Inschrijven</a></li>
                <li><a href="{{ url('/inzetten') }}" class="text-white hover:text-gray-300 font-semibold transition duration-300 transform hover:-translate-y-7">Inzetten</a></li>
                <li><a href="{{ url('/informatie') }}" class="text-white hover:text-gray-300 font-semibold transition duration-300 transform hover:-translate-y-7">Info</a></li>
                <li><a href="{{ route('wedstrijden.index') }}" class="text-white hover:text-gray-300 font-semibold transition duration-300 transform hover:-translate-y-7"> Wedstrijden</a></li>
               
            </ul>
        </nav>

        <div class="w-1/3 flex justify-end">
            @auth
                    <!-- Welkomstbericht -->

                    <span class="text-white font-semibold text-sm">Dankjewel voor het inloggen, {{ Auth::user()->name }}!</span>

                    <!-- Uitlog knop -->
                    <form action="/logout" method="POST" class="ml-4">
                        @csrf
                        <button type="submit" class="bg-white text-blue-600 px-4 py-2 rounded-md hover:bg-gray-200 transition">
                            Logout
                        </button>
                    </form>
                    @else
                    <!-- Wrapper voor knoppen naast elkaar -->
                    <div class="flex space-x-2">
                        <!-- Login knop -->
                        <a href="/login" class="bg-white text-blue-600 px-3 py-2 rounded-md hover:bg-gray-200 transition text-sm">
                            Login
                        </a>

                        <!-- Register knop -->
                        <a href="/register" class="bg-white text-blue-600 px-3 py-2 rounded-md hover:bg-gray-200 transition text-sm">
                            Register
                        </a>
                    </div>
                @endauth
        </div>



    </header>
    <main>
        <div class="container mx-auto p-8">
            @yield('content')  <!-- Dit is waar de inhoud van 'schema.blade.php' komt -->
        </div>

    </main>


</body>
</html>
