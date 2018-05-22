@extends('layouts.master')
@section('page_title', 'Factories')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('factories.create') }}" class="btn btn-sm btn-success">Add New Factory</a>
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($factories) > 0 ? 'datatable' : '' }}" class="hover">
            <thead>
            <tr>
                <th>Factory No</th>
                <th>Name</th>
                <th>Address #1</th>
                <th>City</th>
                <th>Country</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($factories as $factory)
                <tr>
                    <td>{{ $factory->factno }}</td>
                    <td>{{ $factory->factname }}</td>
                    <td>{{ $factory->factaddr1 }}</td>
                    <td>{{ $factory->factcity }}</td>
                    <td>{{ $factory->factcountry }}</td>
                    <td>{{ $factory->factwebsite }}</td>
                    <td>
                        <a href="{{ route('factories.show', $factory->wdt_ID) }}" class="btn btn-success btn-xs">Details</a>
                        <a href="{{ route('factories.edit', $factory->wdt_ID) }}" class="btn btn-warning btn-xs">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="text-align: center;">
            {{ $factories->links() }}
        </div>

    </div>
</div>

@stop

