@extends('layouts.app')
@section('page_title', 'Export CoC')

@section('content')

{!! Form::open(['method' => 'POST', 'route' => 'post-export-item-test']) !!}
<div class="row">
	<div class="col-lg-5"></div>
	<div class="col-lg-5" style="text-align: left;">
		{{ Form::label('Select an Item*') }}<br>
		{{ Form::select('item', $items, null, ['id' => 'selectedItem', 'placeholder' => 'Select an Item', 'required' => 'required']) }}
		<br><br>
		<p>Export as:*</p>
		{{ Form::radio('type', 'pdf', true) }}
		{{ Form::label('PDF') }}<br>

		{{ Form::submit('Submit', ['class' => 'btn btn-success']) }} <br>
		<a href="{{ URL::previous() }}" style="btn btn-primary">Back</a>
	</div>
	<div class="col-lg-2"></div>
</div>

{!! Form::close() !!}

@if($errors->any())
<p class="alert alert-danger" style="margin-top:2em;">{{ $errors->first() }}</p>
@endif

@stop

@section('javascripts')
<script>
	$(document).ready(function() {
	    $('#selectedItem').select2();
	});
</script>
@stop