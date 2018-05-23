@extends('layouts.master')
@section('page_title', 'Item Tests Records')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('items-test-records.create') }}" class="btn btn-sm btn-success">Add New Item Test</a>
        <hr>
        {!! Form::open(['method' => 'POST', 'route' => 'update-item-test-record']) !!}
        @if(isset($selectedItem))
        {{ Form::select('item', $items, $selectedItem, ['id' => 'selectedItem', 'placeholder' => 'Select an Item']) }}
        @else
        {{ Form::select('item', $items, null, ['id' => 'selectedItem', 'placeholder' => 'Select an Item']) }}
        @endif
        {!! Form::close() !!}
        <hr>
        @if(\Auth::user()->role === 'admin')
            {!! Form::open(['method' => 'POST', 'route' => 'update-item-test-record']) !!}
            @if(isset($itemsTest[0]) && (isset($itemsTest[0]->ItemID)))
                {!! Form::hidden('selectedItem', $itemsTest[0]->ItemID) !!}
            @elseif(isset($itemsTest))
                {!! Form::hidden('selectedItem', $itemsTest) !!}
            @endif
            {{ Form::label('Select year Filter') }}<br>
            {{ Form::select('year', $years, $years[2018], ['id' => 'updateIndex']) }}
            {!! Form::close() !!}
            @if(count($errors) > 0)
            <p style="color:red;font-weight: 800;margin-top:2em;">{{$errors->first()}}</p>
            @endif
        @endif

    </div>
    @if(isset($itemsTest) && $itemsTest != '' && isset($itemsTest[0]->ItemID))
    <div class="panel-body table-responsive">
        <table class="table table-bordered hover @if(isset($itemsTest[0]->ItemID))
            {{ count($itemsTest) > 0 ? 'datatable' : '' }} @endif">
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
                        <a href="{{ route('items-test-records.edit', $test) }}" class="btn btn-warning btn-xs">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="text-align: center;">
            {{ $itemsTest->links() }}
        </div>

    </div>
    @elseif((isset($itemsTest) && $itemsTest == '') || isset($itemsTest[0]->ItemID))
        <p style="text-align: center; margin-top:2em;padding-bottom:2em;"><strong>No Tests Found for selected year.</strong></p>
    @endif
</div>

@stop

@section('javascripts')
<script>
    $(document).ready(function(){
        $('#updateIndex').on('change', function(){
            var form = $(this).parent();
            $(form).submit();
        });
         $('#selectedItem').on('change', function(){
            var form = $(this).parent();
            $(form).submit();
        });
    });
</script>
@stop