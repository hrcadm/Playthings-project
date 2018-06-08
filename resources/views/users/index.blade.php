@extends('layouts.master')
@section('page_title', 'Users')

@section('content')

@if (session('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('message') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ route('register') }}"><i class="icon-user-plus"></i> Create New User</a>
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
                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'onsubmit' => 'confirm("Are you sure?")', 'style' => 'display:inline;']) !!}
                        {{ Form::submit('delete', ['class' => 'btn btn-xs btn-danger']) }}
                        {!! Form::close() !!}
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