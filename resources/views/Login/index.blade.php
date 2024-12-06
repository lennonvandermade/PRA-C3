@extends('layouts.navbar')

@section('content')
    <h1>Login Pagina</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <!-- Voeg hier je login velden toe, bijvoorbeeld: -->
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <button type="submit">Login</button>

    </form>


@endsection

