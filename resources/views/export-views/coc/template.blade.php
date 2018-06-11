<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8"/>
	<title></title>
</head>
<body>

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

	<div style="page-break-after: always;"></div>

	<div>
		<table style="width:100%;min-width: 100%;max-width: 100%;">
			<thead style="border: 2px solid black;">
				<tr>
					<th><strong>Testing Laboratory</strong></th>
					<th><strong>Safety Regulation to which this product is being Certified</strong></th>
				</tr>
			</thead>
			<tbody style="border: 2px solid black;">
				@foreach($lab as $labKey => $labValue)
				<tr>
					<td style="border-bottom: 1px solid black; vertical-align: top;">

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
					<td style="border-bottom: 1px solid black;">
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

</body>
</html>