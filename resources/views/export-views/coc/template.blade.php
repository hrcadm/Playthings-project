<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>CoC - {{ $item->itemid }}</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>

<style>
	thead:before, thead:after { display: none; }
	tbody:before, tbody:after { display: none; }
	table {page-break-inside: auto; page-break-before: avoid;}
</style>

<div>
	<div>
		<h1 style="text-align: center;color:#3968a3;">Cerfiticate of Conformity</h1>
	</div>

	<div>
		<p><strong>Item ID:</strong> {{ $item->itemid }}</p>
		<p><strong>Description:</strong> {{ $item->desc1 }}</p>
		<p><strong>Style:</strong></p>
		<p><strong>UPC:</strong> {{ $item->itemid }}</p>
	</div>

	<hr>

	<div>
		<p>
			<strong>Importer:</strong> @if($vendor == '') @else {{ $vendor[0]->vendname }} <br>
			{{ $vendor[0]->addr1 }} <br>
			{{ $vendor[0]->city }}, {{ $vendor[0]->zipcd }} @endif
		</p>
	</div>

	<hr>

	<div>
		<p><strong>Place of Manufacture:</strong> @if($factory == '')  @else {{ $factory[0]->factaddr1 }}, {{ $factory[0]->factcity }}, {{ $factory[0]->factcountry }} @endif</p>
		<p><strong>Date of Manufacture:</strong> </p>
	</div>

	<hr>

	<div>
		<table class="table-bordered">
			<thead>
				<tr>
					<th><strong>Testing Laboratory</strong></th>
					<th><strong>Safety Regulation to which this product is being Certified</strong></th>
				</tr>
			</thead>
			<tbody>
				@foreach($lab as $labKey => $labValue)
				<tr>
					<td style="vertical-align: top;padding-left:0.5em;">

						{{ $labValue->labname }} <br>
						{{ $labValue->labaddr1 }} <br>
						{{ $labValue->labaddr2 }} <br>
						{{ $labValue->labcity }} {{ $labValue->labcity }} <br>
						{{ $labValue->labcountry }} <br>
						<strong>Phone:</strong> {{ $labValue->labphone }} <br>

						@if($testData['TestLab'] == $labValue->id)
							<strong>Test Date:</strong>  {{ date('d-m-Y', strtotime($testData['TestDate'])) }} <br>
							<strong>Report Number:</strong> {{ $testData['ReptNo'] }}
							<br><br><br><br>
							<strong>CPSIA Lead Substrate Level:</strong> {{ $testData['SubstrateLvl'] }} <br>
							<strong>CPSIA Lead Surface Coating Level:</strong> {{ $testData['SurfaceLvl'] }}
						@endif

					</td>
					<td>
						@foreach($tests as $key => $value)
							@foreach($value as $k => $v)
								@foreach($v as $testKey => $testValue)
									@if(array_key_exists('StdName', $testValue) && $testValue['TestLab'] == $labValue->id)
										<ul>
											<li>{{ $testValue['StdName'] }}</li>
										</ul>
									@endif
								@endforeach
							@endforeach
						@endforeach
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>


</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>
</html>