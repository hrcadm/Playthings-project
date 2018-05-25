@extends('layouts.master')

@if(isset($lab))
    @section('page_title', 'Edit Lab')
@else
    @section('page_title', 'Add New Lab')
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
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-file"></i>
                            @if(isset($lab))
                                Lab Information
                            @else
                                Add New Lab
                            @endif
                        </h3>
                    </div>
                    <div class="panel-body">

                        @if(isset($lab))

                        {!! Form::model($lab, [
                                'method' => 'PUT',
                                'route' => ['labs.update', $lab],
                                ])
                        !!}

                        @else

                        {!! Form::open([
                                'method' => 'POST',
                                'route' => 'labs.store',
                                ])
                        !!}

                        @endif

                        <div class="row">

                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Name</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labname', null, ['autofocus' => 'autofocus', 'class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Address #1</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labaddr1', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Address #2</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labaddr2', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab City</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labcity', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab District</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labdistrict', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab State</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labstate', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Country</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labcountry', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Postcode</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labpostalcode', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Phone</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labphone', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Fax</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labfax', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab E-mail</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labemail', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row table editUserTableData">
                                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">Lab Website</div>
                                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
                                        {{ Form::text('labwebsite', null, ['class' => 'form-control']) }}
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