<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toernooien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <div class="container mx-auto p-6">
        <!-- Header Sectie -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">Alle Toernooien</h1>
            <!-- Home Button -->
            <a href="{{ url('/') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none">Home</a>
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

        <!-- Toernooi Tabel -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Toernooi Naam</th>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Status</th>
                        <th class="py-3 px-6 text-sm font-medium tracking-wider">Acties</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($toernooien as $toernooi)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6">{{ $toernooi->naam }}</td>
                        <td class="py-4 px-6">{{ $toernooi->status }}</td>

                        <!-- Start Toernooi Button -->
                        <td class="py-4 px-6">
                            @if($toernooi->status !== 'bezig')
                                <form action="{{ route('toernooi.start', $toernooi->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out">
                                        Start Toernooi
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600">Toernooi is bezig!</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 px-6 text-gray-500">Geen toernooien beschikbaar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
