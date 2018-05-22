@extends('layouts.master')
@section('page_title', 'Item Tests Records')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('items-test-records.create') }}" class="btn btn-sm btn-success">Add New Test</a>
        {!! Form::open(['method' => 'POST', 'route' => 'update-item-test-record']) !!}
        {{ Form::label('Select year Filter') }}
        {{ Form::select('year', $years, $years[2018], ['id' => 'updateIndex']) }}
        {!! Form::close() !!}
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($itemsTest) > 0 ? 'datatable' : '' }}" class="hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item ID</th>
                <th>Desc</th>
                <th>Lab Name</th>
                <th>Test Passed</th>
                <th>Test Desc</th>
                <th>Test Date</th>
                <th>Actions</th>
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
                    <td>
                        <a href="{{ route('items-test-records.edit', $test->id) }}" class="btn btn-warning btn-xs">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="text-align: center;">
            {{ $itemsTest->links() }}
        </div>

    </div>
</div>

@stop

@section('javascripts')
<script>
    $(document).ready(function(){
        $('#updateIndex').on('change', function(){
            $("form").submit();
        });
    });
</script>
@stop