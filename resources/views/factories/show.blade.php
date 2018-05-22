@extends('layouts.master')
@section('page_title', 'View Factory')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-item"></i> Factory information</h3>
            </div>

            <div class="panel-body">


                <div class="row">

                    <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Factory Number</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factno }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Vendor Number</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->vendorno }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Factory Name</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factname }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Address #1</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factaddr1 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Address #2</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factaddr2 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">City</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factcity }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">District</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factdistrict }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">State</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factstate }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Country</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factcountry }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Postcode</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factpostalcd }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Phone</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factphone }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Fax</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factfax }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">E-mail</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factemail }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Website</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->factwebsite }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">SSMA Timestamp</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $factory->ssmatimestamp }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel-footer" style="margin-left: 2em; margin-right:2em;">
                <a href="{{ route('factories.index') }}" class="btn btn-sm btn-primary" type="button"
                        data-toggle="tooltip"
                        data-original-title="Go back"><i class="glyphicon glyphicon-arrow-left"></i></a>
                <span class="pull-right">
                        <a href="{{ route('factories.edit', $factory->wdt_ID) }}" class="btn btn-sm btn-warning" type="button"
                                data-toggle="tooltip"
                                data-original-title="Edit this Factory"><i class="glyphicon glyphicon-edit"></i></a>
                    </span>
            </div>
        </div>
    </div>
</div>
@stop