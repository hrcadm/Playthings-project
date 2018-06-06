@extends('layouts.master')
@section('page_title', 'Vendors')

@section('content')

@if (session('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('message') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('vendors.create') }}" class="btn btn-sm btn-success">Add New Vendor</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered hover {{ count($vendors) > 0 ? 'datatable' : '' }}" id="vendorsTable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Address #1</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->vendname }}</td>
                    <td>{{ $vendor->vendtype }}</td>
                    <td>{{ $vendor->addr1 }}</td>
                    <td>{{ $vendor->city }}</td>
                    <td>{{ $vendor->state }}</td>
                    <td>{{ $vendor->phoneno }}</td>
                    <td>
                        <a href="{{ route('vendors.show', $vendor->wdt_ID) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('vendors.edit', $vendor->wdt_ID) }}" class="btn btn-warning btn-xs">Edit</a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['vendors.destroy', $vendor->wdt_ID], 'onsubmit' => 'confirm("Are you sure?")', 'style' => 'display:inline;']) !!}
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
            $('#vendorsTable').DataTable();
        });
    </script>
@stop