@extends('layouts.master')
@section('page_title', 'Standards')

@section('content')

@if (session('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('message') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('standards.create') }}" class="btn btn-sm btn-success">Add New Standard</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered hover {{ count($standards) > 0 ? 'datatable' : '' }}" id="standardsTable">
            <thead>
            <tr>
                <th>Standard Name</th>
                <th>Standard Description</th>
                <th>Sort Sequence</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($standards as $standard)
                <tr>
                    <td>{{ $standard->stdname }}</td>
                    <td>{{ $standard->stddesc }}</td>
                    <td>{{ $standard->sortsequence }}</td>
                    <td>
                        <a href="{{ route('standards.edit', $standard->wdt_ID) }}" class="btn btn-warning btn-xs">Edit</a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['standards.destroy', $standard->wdt_ID], 'onsubmit' => 'confirm("Are you sure?")', 'style' => 'display:inline;']) !!}
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
            $('#standardsTable').DataTable();
        });
    </script>
@stop