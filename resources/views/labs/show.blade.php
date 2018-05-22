@extends('layouts.master')
@section('page_title', 'View Lab')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-item"></i> Lab information</h3>
            </div>

            <div class="panel-body">


                <div class="row">

                    <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Name</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labname }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Address #1</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labaddr1 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Address #2</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labaddr2 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab City</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labcity }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab District</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->district }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab State</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labstate }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Country</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labcountry }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Postcode</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labpostalcode }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Phone</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labphone }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Fax</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labfax }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab E-mail</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labemail }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Lab Website</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $lab->labwebsite }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel-footer" style="margin-left: 2em; margin-right:2em;">
                <a href="{{ route('labs.index') }}" class="btn btn-sm btn-primary" type="button"
                        data-toggle="tooltip"
                        data-original-title="Go back"><i class="glyphicon glyphicon-arrow-left"></i></a>
                <span class="pull-right">
                        <a href="{{ route('labs.edit', $lab->wdt_ID) }}" class="btn btn-sm btn-warning" type="button"
                                data-toggle="tooltip"
                                data-original-title="Edit this item"><i class="glyphicon glyphicon-edit"></i></a>
                    </span>
            </div>
        </div>
    </div>
</div>
@stop