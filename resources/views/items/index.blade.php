@extends('layouts.master')
@section('page_title', 'Items')

@section('content')

@if (session('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('message') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('items.create') }}" class="btn btn-sm btn-success">Add New Item</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered hover {{ count($items) > 0 ? 'datatable' : '' }}" id="itemsTable">
            <thead>
            <tr>
                <th>Item ID</th>
                <th>Description #1</th>
                <th>Description #2</th>
                <th>Product Category</th>
                <th>Catalog Year</th>
                <th>Factori No</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->itemid }}</td>
                    <td>{{ $item->desc1 }}</td>
                    <td>{{ $item->desc2 }}</td>
                    <td>{{ $item->prodcat }}</td>
                    <td>{{ $item->catalogyear }}</td>
                    <td>{{ $item->factoryno }}</td>
                    <td>
                        <a href="{{ route('items.show', $item->wdt_ID) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('items.edit', $item->wdt_ID) }}" class="btn btn-warning btn-xs">Edit</a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['items.destroy', $item->wdt_ID], 'onsubmit' => 'confirm("Are you sure?")', 'style' => 'display:inline;']) !!}
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
            $('#itemsTable').DataTable();
        });
    </script>
@stop