@extends('layouts.master')
@section('page_title', 'View Item')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-item"></i> Item information</h3>
            </div>

            <div class="panel-body">


                <div class="row">

                    <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">CONO</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->cono }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">WHSE</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->whse }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Item ID</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->itemid }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Description #1</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->desc1 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Description #2</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->desc2 }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Category</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->prodcat }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Catalog Year</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->catalogyear }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Factory No</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->factoryno }}
                            </div>
                        </div>

                        <div class="row table-responsive">
                            <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">SSMA Timestamp</div>
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 test">
                                {{ $item->ssmatimestamp }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel-footer" style="margin-left: 2em; margin-right:2em;">
                <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary" type="button"
                        data-toggle="tooltip"
                        data-original-title="Go back"><i class="glyphicon glyphicon-arrow-left"></i></a>
                <span class="pull-right">
                        <a href="{{ route('items.edit', $item->wdt_ID) }}" class="btn btn-sm btn-warning" type="button"
                                data-toggle="tooltip"
                                data-original-title="Edit this item"><i class="glyphicon glyphicon-edit"></i></a>
                    </span>
            </div>
        </div>
    </div>
</div>
@stop