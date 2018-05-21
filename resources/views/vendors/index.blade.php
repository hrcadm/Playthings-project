@extends('layouts.master')
@section('page_title', 'Vendors')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('vendors.create') }}" class="btn btn-sm btn-success">Add New Vendor</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($vendors) > 0 ? 'datatable' : '' }}" class="hover">
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
                        <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-warning btn-xs">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="text-align: center;">
            {{ $vendors->links() }}
        </div>

    </div>
</div>

@stop

