@extends('layouts.app')

@section('content')
    <h2>Super Admin Dashboard</h2>

    <h4>Clients List</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Users</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->users->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $user }} --}}

    <h4 class="mt-4">All Generated Short URLs</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>URL</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach($urls as $u)
                <tr>
                    {{-- // <td>{{ $u->code }}</td> --}}
                    <td><a href="{{ route('short.resolve', $u->code) }}" target="_blank">{{ $u->code }}</a></td>

                    <td>{{ $u->original_url }}</td>
                    <td>{{ $u->company->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
