@extends('layouts.master')
@section('page_title', 'Factories')

@section('content')

@if (session('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('message') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('factories.create') }}" class="btn btn-sm btn-success">Add New Factory</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($factories) > 0 ? 'datatable' : '' }} hover" id="factoriesTable">
            <thead>
            <tr>
                <th>Factory No</th>
                <th>Name</th>
                <th>Address #1</th>
                <th>City</th>
                <th>Country</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($factories as $factory)
                <tr>
                    <td>{{ $factory->factno }}</td>
                    <td>{{ $factory->factname }}</td>
                    <td>{{ $factory->factaddr1 }}</td>
                    <td>{{ $factory->factcity }}</td>
                    <td>{{ $factory->factcountry }}</td>
                    <td>{{ $factory->factwebsite }}</td>
                    <td>
                        <a href="{{ route('factories.show', $factory->wdt_ID) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('factories.edit', $factory->wdt_ID) }}" class="btn btn-warning btn-xs">Edit</a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['factories.destroy', $factory->wdt_ID], 'onsubmit' => 'confirm("Are you sure?")', 'style' => 'display:inline;']) !!}
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
            $('#factoriesTable').DataTable();
        });
    </script>
@stop
