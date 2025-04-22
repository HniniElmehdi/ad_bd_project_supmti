@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">Journal d'audit</h2>

<table class="table-auto w-full border">
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
@endsection