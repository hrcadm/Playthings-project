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
			<th>{{ $test }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($itemTests as $key => $value)
		<tr>
			<td>
				{{ $key }}
			</td>
			@foreach($value as $k => $v)
				<td>{{ $v->Desc1 }}</td>
				@foreach($tests as $testKey => $test)
					<td>
						@if($v->StdName === $test)
							PASS
						@else
						@endif
					</td>
				@endforeach
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>