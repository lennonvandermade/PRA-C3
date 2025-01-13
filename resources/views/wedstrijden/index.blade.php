<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedstrijden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <div class="container mx-auto p-6">
        <!-- Header Sectie -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">Alle Wedstrijden</h1>
            <form action="{{ route('wedstrijden.generate') }}" method="POST" class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none">Home</a>
                @csrf
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out">
                    Genereer Wedstrijden
                </button>
            </form>
        </div>

        <!-- Succes en Foutmeldingen -->
        @if(session('error'))
            <div class="text-red-600 bg-red-100 p-4 rounded mb-4 shadow-md">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="text-green-600 bg-green-100 p-4 rounded mb-4 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Wedstrijd Tabel -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Wedstrijd</th>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Team 1: Naam - Niveau</th>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Team 2: Naam - Niveau</th>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Datum</th>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Locatie</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($wedstrijden as $wedstrijd)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6">{{ $wedstrijd->team1->teamnaam }} - {{ $wedstrijd->team2->teamnaam }}</td>

                        <!-- Team 1 -->
                        <td class="py-4 px-6">
                            <strong>{{ $wedstrijd->team1->teamnaam }}</strong><br>
                            Niveau: {{ $wedstrijd->team1->niveau }}<br>
                            Inschrijver: {{ $wedstrijd->team1->inschrijver_naam ?? 'Niet beschikbaar' }}
                        </td>

                        <!-- Team 2 -->
                        <td class="py-4 px-6">
                            <strong>{{ $wedstrijd->team2->teamnaam }}</strong><br>
                            Niveau: {{ $wedstrijd->team2->niveau }}<br>
                            Inschrijver: {{ $wedstrijd->team2->inschrijver_naam ?? 'Niet beschikbaar' }}
                        </td>

                        <!-- Match Date and Location -->
                        <td class="py-4 px-6">{{ $wedstrijd->match_date }}</td>  <!-- Hier tonen we gewoon de string -->
                        <td class="py-4 px-6">{{ $wedstrijd->location }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 px-6 text-gray-500">Geen wedstrijden beschikbaar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
