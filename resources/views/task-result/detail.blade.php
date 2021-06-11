@extends('layouts.app')
@section('content')
<section class="section">
	<div class="section-header">
		<h1>Hasil</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Hasil</a></div>
			<div class="breadcrumb-item">Detail</div>
		</div>
	</div>
	<div class="section-body">
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<h2 class="section-title">Detail</h2>
			</div>
			<a href="{{ route('task.result.pdf', $result->id) }}" class="btn btn-sm btn-primary">PDF</a>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div>
							<div class="row mb-3">
								<div class="col-md-2">Nama</div>
								<div class="col-md-10">: {{ $result->user->name }}</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">Siklus</div>
								<div class="col-md-10">: {{ $result->cycle->name }}</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">Tanggal</div>
								<div class="col-md-10">: {{ $result->created_at->translatedformat('l, d F Y') }}</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">Alat</div>
								<div class="col-md-10">: {{ $result->tool->name }}</div>
							</div>
						</div>
						<hr>
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Pertanyaan</th>
									<th>Jawaban</th>
								</tr>
							</thead>
							@foreach ($result->task_result_items as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->task_item->body }}</td>
									<td>{{ $item->value ? 'Baik' : 'Tidak Baik' }}</td>
								</tr>
							@endforeach
							<tr style="border-bottom: solid 1px rgba(0, 0, 0, 30%)"></tr>
							<tr>
								<td> Note </td>
								<td colspan="2"> {{ $result->note ?? '-' }} </td>
							</tr>
						</table>
						<div class="ml-3">
							<p>Images</p>
							@foreach ($result->task_result_images as $image)
								<img src="{{ $image->filename }}" height="230"
								style="object-fit: cover; object-position: center">
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection