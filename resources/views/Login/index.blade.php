<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            LoginLijst
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="flex">Hier komt de loginlijst</p>

                    <table class="border border-black w-full">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 border">User</th>
                                <th class="px-3 py-2 border">Login Time</th>
                                <th class="px-3 py-2 border">IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logins as $login)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $login->user->name }}</td>
                                    <td class="px-3 py-2 border">{{ $login->login_at }}</td>
                                    <td class="px-3 py-2 border">{{ $login->ip_address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
