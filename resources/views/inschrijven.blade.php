@extends('layouts.navbar')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Inschrijven voor een Team</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Inschrijven voor een Team</h1>

        <form action="{{ route('inschrijven.store') }}" method="POST">
            @csrf

            <!-- Team Keuze -->
            <div class="mb-4">
                <label for="team_id" class="block text-gray-700 text-sm font-medium mb-2">Kies een Team</label>
                <select name="team_id" id="team_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->teamnaam }}</option>
                    @endforeach
                </select>
                @error('team_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Inschrijven
                </button>
            </div>
        </form>
    </div>




@endsection
