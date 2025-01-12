@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">

</head>
<body>

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">
            Je bent succesvol ingeschreven voor het team!
        </h2>
        <div class="text-center">
            <p class="text-lg text-gray-600 mb-2">
                Teamnaam:
                <span class="font-bold text-blue-500">{{ $team->teamnaam }}</span>
            </p>
            <p class="text-lg text-gray-600 mb-2">
                Telefoonnummer:
                <span class="font-bold text-blue-500">{{ $team->telefoonnummer }}</span>
            </p>
            <p class="text-lg text-gray-600 mb-2">
                Niveau:
                <span class="font-bold text-blue-500">{{ $team->niveau }}</span>
            </p>
        </div>
        <div class="mt-6 text-center">
            <a href="/" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                Terug naar Home
            </a>
            <a href="wedstrijden" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                Naar Wedstrijden
            </a>
        </div>
    </div>


</body>
</html>

@endsection
