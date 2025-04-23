@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="text-xl font-semibold mb-4">Journal d'audit</h2>

        <form method="GET" action="{{ route('etudiants.audit') }}" class="mb-4 d-flex align-items-center" role="search">
            <select name="column" class="form-select me-2" style="max-width: 200px;">
                <option value="Action" {{ request('column') == 'Action' ? 'selected' : '' }}>Action</option>
                <option value="Date" {{ request('column') == 'Date' ? 'selected' : '' }}>Date</option>
                <option value="Details" {{ request('column') == 'Details' ? 'selected' : '' }}>Détails</option>

            </select>

            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher..."
                value="{{ request('search') }}">

            <button type="submit" class="btn btn-outline-primary me-2">Rechercher</button>

            @if(request('search'))
                <a href="{{ route('etudiants.audit') }}" class="btn btn-outline-secondary">Annuler</a>
            @endif
        </form>


        <table class="table table-bordered">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Action</th>
                    <th class="border px-4 py-2">Table</th>
                    <th class="border px-4 py-2">ID Enregistrement</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td class="border px-4 py-2">{{ $log->Action }}</td>
                        <td class="border px-4 py-2">{{ $log->TableName }}</td>
                        <td class="border px-4 py-2">{{ $log->RecordID }}</td>
                        <td class="border px-4 py-2">{{ $log->Timestamp }}</td>
                        <td class="border px-4 py-2">{{ $log->Details }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection