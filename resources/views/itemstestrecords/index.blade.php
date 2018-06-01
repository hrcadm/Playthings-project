@extends('layouts.master')
@section('page_title', 'Item Test Records')

@section('content')

<style>
    .actionBtn {
        display: inline-block;
        min-width: 100%;
    }
    #updateIndex {
        min-width: 150px;
        max-width: 150px;
    }
    #selectedItem {
        min-width: 150px;
        max-width: 150px;
    }
</style>

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('items-test-records.create') }}" class="btn btn-sm btn-success">Add New Item Test</a>

        <hr>

        {!! Form::open(['method' => 'POST', 'route' => 'update-item-test-record', 'style' => 'display: inline;']) !!}
            @if(isset($selectedItem))
                {{ Form::select('item', $items, $selectedItem, ['id' => 'selectedItem', 'placeholder' => 'Select an Item']) }}
            @else
                {{ Form::select('item', $items, [null => 'Select an Item'] ,['id' => 'selectedItem', 'placeholder' => 'Select an Item']) }}
            @endif

            @if(\Auth::user()->role === 'admin')
                {{ Form::select('year', $years, [null => 'Select Year'], ['id' => 'updateIndex', 'placeholder' => 'Select Year']) }}

                @if(count($errors) > 0)
                    <p style="color:red;font-weight: 800;margin-top:2em;">{{$errors->first()}}</p>
                @endif
            @endif

            {{ Form::submit('submit', ['class' => 'btn btn-xs btn-success']) }}

        {!! Form::close() !!}

        <hr>

    </div>
    @if(isset($itemsTest))
        <div class="panel-body table-responsive">

            <table class="table table-bordered hover @if(isset($itemsTest[0]->ItemID))
                {{ count($itemsTest) > 0 ? 'datatable' : '' }} @endif" id="itemsTestRecordsTable">
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
                            <a href="{{ route('items-test-records.edit', $test) }}" class="btn btn-warning btn-xs actionBtn">Edit</a>
                            <a href="{{ route('items-test-records.clone', $test) }}" class="btn btn-primary btn-xs actionBtn">Clone</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    @endif
</div>

@stop

@section('javascripts')
<script>
    $(document).ready(function(){
        $('#selectedItem').select2();
        $('#updateIndex').select2();
    });
</script>
@stop
