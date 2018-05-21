@extends('layouts.master')
@section('page_title', 'View Vendor')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-item"></i> Vendor information</h3>
            </div>

            <div class="panel-body">


                <div class="row">

                    <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Name</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->vendname }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Type</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->vendtype }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">CONO</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->cono }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Vendor Number</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->vendno }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Address #1</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->addr1 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Address #2</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->addr2 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">City</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->city }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">State</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->state }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Postcode</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->zipcd }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Phone Number</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->phoneno }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">AP Cust Number (apcustno?)</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->apcustno }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">SSMA Timestamp</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $vendor->ssmatimestamp }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel-footer" style="margin-left: 2em; margin-right:2em;">
                <a href="{{ route('vendors.index') }}" class="btn btn-sm btn-primary" type="button"
                        data-toggle="tooltip"
                        data-original-title="Go back"><i class="glyphicon glyphicon-arrow-left"></i></a>
                <span class="pull-right">
                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-sm btn-warning" type="button"
                                data-toggle="tooltip"
                                data-original-title="Edit this Vendor"><i class="glyphicon glyphicon-edit"></i></a>
                    </span>
            </div>
        </div>
    </div>
</div>
@stop