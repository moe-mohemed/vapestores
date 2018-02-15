@extends('layout')

@section('content')
    <div class="page-title">
        <div class="contains">
            <h1>Users</h1>
        </div>
    </div>
    <div class="contains">
        <div class="table-responsive" style="padding: 25px 0 0;">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Activation</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($usersAll as $listUser)
                        <tr {!! !$listUser->activated? 'class="warning"' : '' !!}>
                            <td class="text-primary"><strong>{{ $listUser->name }}</strong></td>
                            <td>{{ $listUser->username }}</td>
                            <td>{{ $listUser->email }}</td>
                            <td>{!! $listUser->activated? 'Yes' : 'No' !!}</td>
                            <td>{{ $listUser->created_at->diffForHumans() }}</td>
                            <td>{{ $listUser->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
