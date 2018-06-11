<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<table>
	<thead>
		<tr>
			<th>Item ID</th>
			<th colspan="4">Description</th>
			@foreach($tests as $key => $test)
				<th colspan="3">{{ $test }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($array as $key => $value)
			<tr>
				<td>
					{{ $key }}
				</td>
				<td colspan="4">{{ $value['Desc1'] }}</td>
				@foreach($value as $k => $v)
					@if(array_search("StdName", $tests) !== false)
						<td colspan="3">PASS</td>
					@else
						<td colspan="3"></td>
					@endif
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>