@extends('layouts.navbar')

@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Voer je e-mailadres in en stel een nieuw wachtwoord in.') }}
    </div>

    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.direct-reset') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">E-mailadres</label>
            <input id="email" type="email" name="email" class="block mt-1 w-full" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mt-4">
            <label for="password">Nieuw wachtwoord</label>
            <input id="password" type="password" name="password" class="block mt-1 w-full" required>
            @error('password')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">Bevestig wachtwoord</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="block mt-1 w-full" required>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring">
                {{ __('Wachtwoord Bijwerken') }}
            </button>
        </div>
    </form>
@endsection
