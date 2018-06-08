<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<table>
	<thead>
		<tr>
			<th colspan="6" style="color:#5186a5; text-align: center;">ITEM SAFETY TEST REPORT</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Item ID: </td>
			<td>{{ $item[0]->itemid }}</td>
			<td>{{ $item[0]->desc1 }}</td>
		</tr>
		<tr></tr>
		<tr>
			<td>Lab:</td>
			<td>{{ $itemTests[0]->LabName }}</td>
			<td></td>
			<td></td>
			<td colspan="3">Test Report Number</td>
			<td>{{ $itemTests[0]->ReptNo }}</td>
		</tr>
		<tr>
			<td>Test Report PDF:</td>
			<td>{{ $itemTests[0]->TestReptPdf }}</td>
		</tr>
		<tr>
			<td colspan="3">CPSIA Lead Substrate Level:</td>
			<td>
				@if($itemTests[0]->SubstrateLvl === 1)
					&lt; 600 PPM
				@elseif($itemTests[0]->SubstrateLvl === 2)
					&lt; 300 PPM
				@elseif($itemTests[0]->SubstrateLvl === 3)
					&lt; 100 PPM
				@else
					N/A
				@endif
			</td>
			<td></td>
			<td colspan="4">CPSIA Lead Surface Coating Level</td>
			<td>
				@if($itemTests[0]->SurfaceLvl === 1)
					&lt; 600 PPM
				@elseif($itemTests[0]->SurfaceLvl === 2)
					&lt; 90 PPM
				@else
					N/A
				@endif
			</td>
		</tr>
	</tbody>
</table>

<table>
	<thead>
		<tr>
<<<<<<< HEAD
            <th>Test Date</th>
            <th>Report Number</th>
			<th>Test Name</th>
			<th>Test Description</th>
=======
			<th colspan="4">Test Date / Report Number</th>
			<th colspan="4">Test Name</th>
			<th colspan="4">Test Description</th>
>>>>>>> 88e117c50e7b216e17e17fbd059b4060cdfb016e
		</tr>
	</thead>
	<tbody>
		@foreach($itemTests as $item)
		<tr>
<<<<<<< HEAD
			<td>{{ date('m/d/Y', strtotime($item->TestDate)) }}</td>
            <td>{{ $item->ReptNo }}</td>
			<td>{{ $item->StdName }}</td>
			<td>{{ $item->StdDesc }}</td>
=======
			<td colspan="4">
				{{ date('m/d/Y', strtotime($item->TestDate)) }} ||
				{{ $item->ReptNo }}
			</td>
			<td colspan="4">{{ $item->StdName }}</td>
			<td colspan="4">{{ $item->StdDesc }}</td>
>>>>>>> 88e117c50e7b216e17e17fbd059b4060cdfb016e
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>