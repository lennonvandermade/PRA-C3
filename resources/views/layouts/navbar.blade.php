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
    <header class="bg-white-400 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo Centraal in het Midden -->
            <div class="w-1/3"></div> <!-- Lege ruimte om de logo te centreren -->

            <!-- Logo -->
            <img src="{{ asset('/img/schoolvoetbal.png') }}" alt="School Voetbal Logo" class="h-40 w-65">



            <!-- Login knop Rechts -->
            <div class="w-1/3 flex justify-end">
                <button class="bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition">Login</button>
            </div>
        </div>

        <!-- Navigatielinks Gecentreerd -->
        <nav class="container mx-auto mt-8 py-8">
            <ul class="bg-blue-400 flex justify-center space-x-8">
                <li><a href="{{ url('/schema') }}" class="text-white hover:text-gray-900 font-semibold">Schema</a></li>
                <li><a href="{{ url('/inschrijven') }}" class="text-white hover:text-gray-900 font-semibold">Inschrijven</a></li>
                <li><a href="{{ url('/wedden') }}" class="text-white hover:text-gray-900 font-semibold">Wedden</a></li>
                <li><a href="{{ url('/info') }}" class="text-white hover:text-gray-900 font-semibold">Info</a></li>
            </ul>
        </nav>
    </header>


</body>
</html>
