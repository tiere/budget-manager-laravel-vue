@extends('layouts.app')

@section('content')
    <h1>Accounts</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($accounts as $account)
                <tr>
                    <td>{{ $account->name }}</td>
                </tr>
                @empty
                    <tr>
                        <td>No accounts</td>
                    </tr>
                @endforelse
        </tbody>
    </table>

    {!! link_to_route('accounts.create', 'New accout', [], ['class' => 'btn btn-primary']) !!}
@endsection
