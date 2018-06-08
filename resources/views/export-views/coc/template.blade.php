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
		<p><strong>Item ID:</strong> {{ $tests[0]->ItemID }}</p>
		<p><strong>Description:</strong> {{ $tests[0]->Desc1 }}</p>
		<p><strong>Style:</strong></p>
		<p><strong>UPC:</strong> {{ $tests[0]->ItemID }}</p>
	</div>

	<hr>

	<div>
		<p>
			<strong>Importer:</strong> {{ $vendor[0]->vendname }} <br>
			{{ $vendor[0]->addr1 }} <br>
			{{ $vendor[0]->city }}, {{ $vendor[0]->zipcd }}
		</p>
	</div>

	<hr>

	<div>
		<p><strong>Place of Manufacture:</strong> {{ $factory[0]->factaddr1 }}, {{ $factory[0]->factcity }}, {{ $factory[0]->factcountry }} </p>
		<p><strong>Date of Manufacture:</strong> </p>
	</div>

	<hr>

	<div>
		<table style="width:100%;min-width: 100%;max-width: 100%;">
			<thead style="border: 2px solid black;">
				<tr>
					<th><strong>Testing Laboratory</strong></th>
					<th><strong>Safety Regulation to which this product is being Certified</strong></th>
				</tr>
			</thead>
			<tbody style="border: 2px solid black;">
				@foreach($tests as $test)
					@foreach($test->TestLab as $labLoop)
					<tr>
						<td>
							{{ $labLoop->labname }} <br>
							{{ $labLoop->labaddr1 }} <br>
							{{ $labLoop->labaddr2 }} <br>
							{{ $labLoop->labcity }} {{ $labLoop->labcity }} <br>
							{{ $labLoop->labcountry }} <br>
							<strong>Phone:</strong> {{ $labLoop->labphone }} <br>
							<strong>Test Date:</strong> {{ $test->TestDate }} <br>
							<strong>Report Number:</strong> {{ $test->ReptNo }}
							<br><br><br><br>
							<strong>CPSIA Lead Substrate Level: {{ $test->SubstrateLvl }}</strong>
							<strong>CPSIA Lead Surface Coating Level: {{ $test->SurfaceLvl }}</strong>
						</td>
						<td>
							{{ $test->StdName }}
						</td>
					</tr>
					@endforeach
				@endforeach
			</tbody>
		</table>
	</div>


</div>

</body>
</html>