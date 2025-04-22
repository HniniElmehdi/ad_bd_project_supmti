<!-- resources/views/etudiants/archives.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Archived Students</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Prénom</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Archiving Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($archives as $student)
            <tr>
                <td>{{ $student->Nom }}</td>
                <td>{{ $student->Prénom }}</td>
                <td>{{ $student->DateNaissance }}</td>
                <td>{{ $student->Email }}</td>
                <td>{{ $student->DateSuppression }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection