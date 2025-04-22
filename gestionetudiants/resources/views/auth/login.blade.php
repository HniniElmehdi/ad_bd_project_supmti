@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Login</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" id="Email" value="{{ old('Email') }}" name="Email" required>
        </div>
        <div class="mb-3">
            <label for="MotDePasse" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="MotDePasse" name="MotDePasse" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection