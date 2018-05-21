@extends('layouts.master')
@section('page_title', 'Users')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        Users
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($users) > 0 ? 'datatable' : '' }}" id="customersTable" class="hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-xs">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('javascripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#customersTable').DataTable();
        });
    </script>
@stop