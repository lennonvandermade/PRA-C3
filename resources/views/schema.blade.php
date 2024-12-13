@extends('layouts.navbar')

@section('content')

    <!-- Teams Lijst -->
    <main class="max-w-6xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-8">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Teams Lijst</h1>

        <!-- Button om een nieuw team aan te maken -->
        <div class="mb-4 text-center">
            <a href="/teams/create" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                Nieuw team aanmaken
            </a>
        </div>

        <!-- Tabel van teams -->
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b">Inschrijver</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b">Teamnaam</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b">Telefoonnummer</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b">Niveau</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-800 border-b">{{ $team->inschrijver_naam }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 border-b">{{ $team->teamnaam }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 border-b">{{ $team->telefoonnummer }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 border-b">{{ $team->niveau }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 border-b">

                            <div class="flex space-x-4 mb-6">
                                <!-- Bewerk Team Button -->
                                <a href="{{ route('teams.edit', $team->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out">
                                    Bewerk Team
                                </a>

                                <!-- Verwijder Team Button -->
                                <form action="{{ route('teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit team wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out">
                                        Verwijder Team
                                    </button>
                                </form>
                            </div>

                            




                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

@endsection
