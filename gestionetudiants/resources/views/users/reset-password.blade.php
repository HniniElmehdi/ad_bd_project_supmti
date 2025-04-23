@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Réinitialiser le mot de passe de {{ $user->Nom }} {{ $user->Prénom }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.resetPassword', $user->IDUser) }}">
            @csrf

            <div class="mb-3">
                <label for="new_password" class="form-label">Nouveau mot de passe</label>
                <input type="text" name="new_password" id="new_password" class="form-control"
                    value="{{ $generatedPassword }}" readonly>
            </div>

            <div class="mb-3">
                <a href="{{ route('admin.users.resetPasswordForm', $user->IDUser) }}" class="btn btn-secondary">Générer un
                    autre mot de passe</a>
                <button type="submit" class="btn btn-primary">Confirmer</button>
            </div>
        </form>
    </div>
@endsection