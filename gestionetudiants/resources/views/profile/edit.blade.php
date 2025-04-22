@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-semibold mb-4">Modifier le Profil</h2>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="Email" value="{{ old('Email', $user->Email) }}" class="w-full p-2 border rounded">
            @error('Email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block"> mot de passe</label>
            <input type="password" name="current_password" required placeholder="Mot de passe actuel">

            @error('current_password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>



        <div class="mb-4">
            <label class="block">Nouveau mot de passe</label>

            <input type="password" name="MotDePasse" class="w-full p-2 border rounded">
            @error('MotDePasse')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block">Confirmer mot de passe</label>
            <input type="password" name="MotDePasse_confirmation" class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Sauvegarder</button>
    </form>
</div>
@endsection