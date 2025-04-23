@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Modifier le Profil</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" name="Email" id="Email" value="{{ old('Email', $user->Email) }}"
                                    class="form-control @error('Email') is-invalid @enderror">
                                @error('Email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mot de passe actuel</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror" required
                                    placeholder="Mot de passe actuel">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="MotDePasse" class="form-label">Nouveau mot de passe</label>
                                <input type="password" name="MotDePasse" id="MotDePasse"
                                    class="form-control @error('MotDePasse') is-invalid @enderror">
                                @error('MotDePasse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="MotDePasse_confirmation" class="form-label">Confirmer mot de passe</label>
                                <input type="password" name="MotDePasse_confirmation" id="MotDePasse_confirmation"
                                    class="form-control">
                            </div>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-success float-end">Sauvegarder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection