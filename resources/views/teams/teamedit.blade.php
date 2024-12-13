@extends('layouts.navbar')

@section('content')
<main class="max-w-6xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-8">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Team Bewerken</h1>

    <form action="{{ route('teams.update', $team->id) }}" method="POST">  <!-- Verwijs naar de juiste update route -->
        @csrf
        @method('PUT')  <!-- Zorg ervoor dat het formulier een PUT-verzoek doet -->

        <div class="mb-4">
            <label for="inschrijver_naam" class="block text-sm font-medium text-gray-700">Naam van de Inschrijver</label>
            <input type="text" id="inschrijver_naam" name="inschrijver_naam"
                class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('inschrijver_naam', $team->inschrijver_naam) }}">
            @error('inschrijver_naam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="teamnaam" class="block text-sm font-medium text-gray-700">Teamnaam</label>
            <input type="text" id="teamnaam" name="teamnaam"
                class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('teamnaam', $team->teamnaam) }}">
            @error('teamnaam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telefoonnummer" class="block text-sm font-medium text-gray-700">Telefoonnummer</label>
            <input type="text" id="telefoonnummer" name="telefoonnummer"
                class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('telefoonnummer', $team->telefoonnummer) }}">
            @error('telefoonnummer')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="niveau" class="block text-sm font-medium text-gray-700">Niveau van het Team</label>
            <input type="text" id="niveau" name="niveau"
                class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('niveau', $team->niveau) }}">
            @error('niveau')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit knop -->
        <div class="flex justify-center mt-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300 ease-in-out">
                Wijzigingen Opslaan
            </button>
        </div>
    </form>
</main>
@endsection
