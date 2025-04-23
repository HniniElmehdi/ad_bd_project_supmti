@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Mon Profil</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            <strong>Nom d'utilisateur :</strong>
                            <span class="text-muted">{{ $user->Nom }}</span>
                        </p>
                        <p class="mb-3">
                            <strong>Email :</strong>
                            <span class="text-muted">{{ $user->Email }}</span>
                        </p>
                        <p class="mb-3">
                            <strong>Rôle :</strong>
                            <span class="badge bg-info text-dark">{{ ucfirst($user->user_role) }}</span>
                        </p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary mt-3">
                            Modifier le profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection