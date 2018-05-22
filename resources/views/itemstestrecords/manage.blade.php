@extends('layouts.master')

@if(isset($itemTest))
    @section('page_title', 'Edit Test')
@else
    @section('page_title', 'Add New Test')
@endif

@section('content')

    <style>
        .editUserTableData {
            padding-bottom: 0.5em;
            padding-top: 0.5em;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-file"></i>
                            @if(isset($itemTest))
                                Item Test Information
                            @else
                                Add New Item Test
                            @endif
                        </h3>
                    </div>
                    <div class="panel-body">

                        @if(isset($itemTest))

                        {!! Form::model($itemTest, [
                                'method' => 'PUT',
                                'route' => ['items-test-records.update', $itemTest],
                                ])
                        !!}

                        @else

                        {!! Form::open([
                                'method' => 'POST',
                                'route' => 'items-test-records.store',
                                ])
                        !!}

                        @endif

                        <div class="row">

                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">
                                        Select Item
                                        @if(isset($itemTest))
                                            ( Default: {{ $itemTest->ItemID }} )
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::select('ItemID', $items, null, ['style' => 'max-width:100%;min-width:100%;', 'placeholder' => 'Pick one...']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">
                                        Select Lab
                                         @if(isset($itemTest))
                                            ( Default: {{ $itemTest->LabName }} )
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::select('LabName', $lab, null, ['style' => 'max-width:100%;min-width:100%;', 'placeholder' => 'Pick one...']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">
                                        Select Factory
                                         @if(isset($itemTest))
                                            ( Default:
                                            @if(isset($itemTest->factname))
                                                {{ $itemTest->factname }} )
                                            @else
                                                None )
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::select('factname', $factory, null, ['style' => 'max-width:100%;min-width:100%;', 'placeholder' => 'Pick one...']) }}
                                    </div>
                                </div>

                                <hr style="color:lightblue;border:1px solid lightblue;">

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Test Report Number</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('testRepNo', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">PO Number</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('ponum', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Testing Date (mm/dd/yyyy)</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('TestDate', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Description</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('Desc1', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">CPSIA Lead Substrate Level</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        @if(isset($itemTest) && $itemTest->SubstrateLvl === 1)
                                            {{ Form::radio('substrateLvl', 1, ['checked' => 'checked']) }}
                                            {{ Form::label('<600 PPM', null, ['style' => 'margin-right:1.5em;']) }}
                                        @else
                                            {{ Form::radio('substrateLvl', 1) }}
                                            {{ Form::label('<600 PPM', null, ['style' => 'margin-right:1.5em;']) }}
                                        @endif
                                        @if(isset($itemTest) && $itemTest->SubstrateLvl === 2)
                                            {{ Form::radio('substrateLvl', 2, ['checked' => 'checked']) }}
                                            {{ Form::label('<300 PPM', null, ['style' => 'margin-right:1.5em;']) }}
                                        @else
                                            {{ Form::radio('substrateLvl', 2) }}
                                            {{ Form::label('<300 PPM', null, ['style' => 'margin-right:1.5em;']) }}
                                        @endif
                                        @if(isset($itemTest) && $itemTest->SubstrateLvl === 3)
                                            {{ Form::radio('substrateLvl', 3, ['checked' => 'checked']) }}
                                            {{ Form::label('<100 PPM', null, ['style' => 'margin-right:1.5em;']) }}
                                        @else
                                            {{ Form::radio('substrateLvl', 3) }}
                                            {{ Form::label('<100 PPM', null, ['style' => 'margin-right:1.5em;']) }}
                                        @endif
                                        @if(isset($itemTest) && $itemTest->SubstrateLvl === 4)
                                            {{ Form::radio('substrateLvl', 4,['checked' => 'checked']) }}
                                            {{ Form::label('N/A') }}
                                        @else
                                            {{ Form::radio('substrateLvl', 4) }}
                                            {{ Form::label('N/A') }}
                                        @endif
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">CPSIA Lead Surface Coating Level</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        @if(isset($itemTest) && $itemTest->SurfaceLvl === 1)
                                            {{ Form::radio('SurfaceLvl', 1, ['checked' => 'checked']) }}
                                            {{ Form::label('<600 PPM', null, ['style' => 'margin-right:2em;']) }}
                                        @else
                                            {{ Form::radio('SurfaceLvl', 1) }}
                                            {{ Form::label('<600 PPM', null, ['style' => 'margin-right:2em;']) }}
                                        @endif
                                        @if(isset($itemTest) && $itemTest->SurfaceLvl === 2)
                                            {{ Form::radio('SurfaceLvl', 2, ['checked' => 'checked']) }}
                                            {{ Form::label('<90 PPM', null, ['style' => 'margin-right:2em;']) }}
                                        @else
                                            {{ Form::radio('SurfaceLvl', 2) }}
                                            {{ Form::label('<90 PPM', null, ['style' => 'margin-right:2em;']) }}
                                        @endif
                                        @if(isset($itemTest) && $itemTest->SurfaceLvl === 2)
                                            {{ Form::radio('SurfaceLvl', 3, ['checked' => 'checked']) }}
                                            {{ Form::label('N/A') }}
                                        @else
                                            {{ Form::radio('SurfaceLvl', 3) }}
                                            {{ Form::label('N/A') }}
                                        @endif
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Test Report (PDF)</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('TestReptPdf', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5"><strong>Select Safety Tests</strong></div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7"></div>
                                </div>

                                <div class="row editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        @foreach(array_slice($standards->toArray(), 0, 50) as $key => $value)
                                            @if(isset($itemTest) && $itemTest->StdName === $value)
                                                {{ Form::checkbox('tests[]', $value, ['checked' => 'checked']) }}
                                                {{ Form::label($value) }}<br>
                                            @else
                                                {{ Form::checkbox('tests[]', $value) }}
                                                {{ Form::label($value) }}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        @foreach(array_slice($standards->toArray(), 50, 100) as $standard)
                                            @if(isset($itemTest) && $itemTest->StdName === $standard)
                                                {{ Form::checkbox('tests[]', $standard, ['checked' =>'checked']) }}
                                                {{ Form::label($standard) }}<br>
                                            @else
                                                {{ Form::checkbox('tests[]', $standard) }}
                                                {{ Form::label($standard) }}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="panel-footer" style="margin-left: 2em; margin-right:2em;">
                        <span class="pull-right">
                            {{ Form::submit('submit', ['class' => 'btn btn-sm btn-success', 'data-toggle' => 'tooltip', 'data-original-title' => 'Save changes', 'type' => 'submit'])  }}
                            {!! Form::close() !!}
                            <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary" type="button"
                               data-toggle="tooltip"
                               data-original-title="Cancel Changes">Cancel</a>
                            </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('javascripts')
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@stop