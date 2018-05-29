@extends('layouts.master')
@section('page_title', 'Labs')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('labs.create') }}" class="btn btn-sm btn-success">Add New Lab</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered hover {{ count($labs) > 0 ? 'datatable' : '' }}" id="labsTable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Address #1</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($labs as $lab)
                <tr>
                    <td style="max-width: 15em;">{{ $lab->labname }}</td>
                    <td>{{ $lab->labaddr1 }}</td>
                    <td>{{ $lab->labcity }}</td>
                    <td>{{ $lab->labstate }}</td>
                    <td>{{ $lab->labcountry }}</td>
                    <td>
                        <a href="{{ route('labs.show', $lab->wdt_ID) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('labs.edit', $lab->wdt_ID) }}" class="btn btn-warning btn-xs">Edit</a>
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
            $('#labsTable').DataTable();
        });
    </script>
@stop