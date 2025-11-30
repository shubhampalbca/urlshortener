@extends('layouts.app')

@section('content')
    <h2>Admin Dashboard</h2>

    {{-- Short URL Creation Form --}}
   <div class="card mb-4">
        <div class="card-header">Generate Short URL</div>
        <div class="card-body">
            <form method="POST" action="{{ route('short.create') }}">
                @csrf
                <div class="input-group">
                    <input type="hidden" name="user_id" class="form-control" value="{{ $user->id }}">
                    <input type="hidden" name="company_id" class="form-control" value="{{ $user->company_id }}">
                    <input type="url" name="url" class="form-control" placeholder="Paste your link here" required>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>

        </div>
    </div>


    {{-- {{ $user }} --}}
    {{-- URLs Created by This Admin --}}
    <h4>My Created Short URLs</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Original URL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($myUrls as $u)
                <tr>
                    <td><a href="{{ route('short.resolve', $u->code) }}" target="_blank">{{ $u->code }}</a></td>
                    <td>{{ $u->original_url }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  

    {{-- Team Members --}}
    <h4 class="mt-4">Team Members</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $m)
                <tr>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
