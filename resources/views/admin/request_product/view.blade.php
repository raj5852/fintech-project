<div class="card m-4 p-3">
	<div class="card-header">
		Date : {{ $data->created_at->format('d M Y') }}
	</div>
	<div class="card-body">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>:</th>
				<td>{{ $data->customer_name }}</td>
			</tr>
			<tr>
				<th>Email</th>
				<th>:</th>
				<td>{{ $data->customer_email }}</td>
			</tr>
			<tr>
				<th>Software Name</th>
				<th>:</th>
				<td>{{ $data->software_name }}</td>
			</tr>
			
			<tr>
				<th>Details</th>
				<th>:</th>
				<td>{{ $data->details }}</td>
			</tr>
		</table>
	</div>
</div>
