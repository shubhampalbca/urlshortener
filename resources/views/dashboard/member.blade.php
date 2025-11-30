@extends('layouts.app')

@section('content')
    <h2>Member Dashboard</h2>

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

    <h4>Short URLs </h4>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Original URL</th>

            </tr>
        </thead>
        <tbody>
            @forelse($urls as $u)
                <tr>
                    {{-- <td>{{ $u->code }}</td> --}}
                    <td><a href="{{ route('short.resolve', $u->code) }}" target="_blank">{{ $u->code }}</a></td>

                    <td>{{ $u->original_url }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-danger">No URLs available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
