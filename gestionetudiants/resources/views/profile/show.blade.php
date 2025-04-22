@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-semibold mb-4">Mon Profil</h2>

    <p><strong>Nom d'utilisateur:</strong> {{ $user->Nom }}</p>
    <p><strong>Email:</strong> {{ $user->Email }}</p>
    <p><strong>Rôle:</strong> {{ ucfirst($user->user_role) }}</p>

    <a href="{{ route('profile.edit') }}"
        class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Modifier</a>
</div>
@endsection