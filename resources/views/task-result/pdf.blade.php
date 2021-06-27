<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PDF</title>
	<style>
		.table-body, .table-header {
		  font-family: Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}
		
		.table-body td, .table-body th, .table-header td {
		  border: 1px solid #ddd;
		  padding: 8px;
		}
		
		.table-body tr:nth-child(even), .table-header tr:nth-child(even){
			background-color: #f2f2f2;
		}
		
		.table-body tr:hover, .table-header tr:hover {
			background-color: #ddd;
		}
		
		.table-body th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #04AA6D;
		  color: white;
		}
		.table-header{
			margin-bottom: 1rem;
		}
		.images, .note{
			margin-left: 0.5rem;
		}
		</style>
</head>
<body>
	<h2><center>Hasil Pemeliharaan & Perawatan</center></h2>
	<table class="table-header">
		<tr>
			<td>Nama</td>
			<td>: {{ $result->user->name }}</td>
		</tr>
		<tr>
			<td>Siklus</td>
			<td>: {{ $result->cycle->name }}</td>
		</tr>

		<tr>
			<td>Tanggal</td>
			<td>: {{ $result->created_at->translatedformat('l, d F Y') }}</td>
		</tr>
		<tr>
			<td>Alat</td>
			<td>: {{ $result->tool->name }}</td>
		</tr>
	</table>
	<table class="table-body">
		<thead>
			<tr>
				<th>No</th>
				<th>Pertanyaan</th>
				<th>Jawaban</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($result->task_result_items as $item)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $item->task_item->body }}</td>
					<td>{{ $item->value ? 'Baik' : 'Tidak Baik' }}</td>
				</tr>
			@endforeach
			{{-- <tr>
				<td> Note </td>
				<td colspan="2"> {{ $result->note ?? '-' }} </td>
			</tr> --}}
		</tbody>
	</table>
	<div class="note">
		<p style="margin: 0; padding: 0; margin-top: 10px;">Note</p>
		<p>{{ $result->note ?? '-' }}</p>
	</div>
	<div class="images">
		<p>Images</p>
		@foreach ($result->task_result_images as $image)
			<img src="{{ $image->filename }}" height="230"
			style="object-fit: cover; object-position: center">
		@endforeach
	</div>
</body>
</html>