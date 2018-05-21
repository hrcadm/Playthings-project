@extends('layouts.master')
@section('page_title', 'Standards')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('standards.create') }}" class="btn btn-sm btn-success">Add New Standard</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($standards) > 0 ? 'datatable' : '' }}" id="standardsTable" class="hover">
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
                        <a href="{{ route('standards.show', $standard->id) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('standards.edit', $standard->id) }}" class="btn btn-warning btn-xs">Edit</a>
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