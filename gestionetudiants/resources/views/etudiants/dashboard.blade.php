@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mes Cours</h1>

        @if(count($cours) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titre du Cours</th>
                        <th>Nom Complet du Professeur</th>
                        <th>Crédit</th>
                        <th>Date d'Inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cours as $c)
                        <tr>
                            <td>{{ $c->TitreCours }}</td>
                            <td>{{ $c->Nom }} {{ $c->Prénom }}</td>
                            <td>{{ $c->Crédit }}</td>
                            <td>{{ $c->DateInscription }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Vous n'êtes inscrit à aucun cours pour le moment.</p>
        @endif
    </div>
@endsection