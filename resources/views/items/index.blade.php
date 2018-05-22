@extends('layouts.master')
@section('page_title', 'Items')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('items.create') }}" class="btn btn-sm btn-success">Add New Item</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($items) > 0 ? 'datatable' : '' }}" id="itemsTable" class="hover">
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="text-align: center;">
            {{ $items->links() }}
        </div>

    </div>
</div>

@stop

