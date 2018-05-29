@extends('layouts.master')
@section('page_title', 'Item Tests Records Archive')

@section('content')

<div class="panel panel-default">

    <div class="panel-heading text-center">
        Archive
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered hover {{ count($itemsTest) > 0 ? 'datatable' : '' }}" id="archiveTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item ID</th>
                <th>Desc</th>
                <th>Lab Name</th>
                <th>Test Passed</th>
                <th>Test Desc</th>
                <th>Test Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($itemsTest as $test)
                <tr>
                    <td>{{ $test->id }}</td>
                    <td>{{ $test->ItemID }}</td>
                    <td>{{ $test->Desc1 }}</td>
                    <td>{{ $test->LabName }}</td>
                    <td>{{ $test->StdName }}</td>
                    <td>{{ $test->StdDesc }}</td>
                    <td>{{ $test->TestDate }}</td>
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
            $('#archiveTable').DataTable();
        });
    </script>
@stop