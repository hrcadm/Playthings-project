<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8"/>
	<title></title>
</head>
<body>

<div>
	<div>
		<h1 style="text-align: center;color:#3968a3;">Item Safety Test Report</h1>
	</div>

	<div>
		<p style="display: inline;padding-right:245px;"><strong>Item ID:</strong> {{ $itemTests[0]->ItemID }}</p>
		<p style="display: inline;"><em>{{ $itemTests[0]->Desc1 }}</em></p>
	</div>

	<div>
		<p style="display: inline;padding-right:235px;"><strong>Lab:</strong> {{ $itemTests[0]->LabName }}</p>
		<p style="display: inline;"><strong>Test Report No:</strong> {{ $itemTests[0]->ReptNo }}</p>
	</div>

	<div>
		<p><strong>Test Report PDF:</strong> {{ $itemTests[0]->TestReptPdf }}</p>
	</div>

	<div>
		<p style="display: inline;padding-right:80px;">
			<strong>CPSIA Lead Substrate Level:</strong>
			@if($itemTests[0]->SubstrateLvl === 1)
				&lt; 600 PPM
			@elseif($itemTests[0]->SubstrateLvl === 2)
				&lt; 300 PPM
			@elseif($itemTests[0]->SubstrateLvl === 3)
				&lt; 100 PPM
			@else
				N/A
			@endif
		</p>
		<p style="display: inline;">
			<strong>CPSIA Lead Surface Coating Level:</strong>
			@if($itemTests[0]->SurfaceLvl === 1)
				&lt; 600 PPM
			@elseif($itemTests[0]->SurfaceLvl === 2)
				&lt; 90 PPM
			@else
				N/A
			@endif
		</p>
	</div>

	<div style="margin-top:10px;">
		<table style="border-collapse: collapse;">
			<thead>
				<tr style="background-color:#3968a3;color:white;">
					<th>Test Date / Report Number</th>
					<th>Test Name</th>
					<th>Test Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach($itemTests as $test)
				<tr>
					<td style="border-bottom:1px solid black;">{{ date('m/d/Y', strtotime($test->TestDate)) }} <br> Rpt #: {{ $test->ReptNo }}</td>
					<td style="border-bottom:1px solid black;">{{ $test->StdName }}</td>
					<td style="border-bottom:1px solid black;">{{ $test->StdDesc }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</div>

</body>
</html>