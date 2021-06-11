@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Hasil</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Hasil</a></div>
            <div class="breadcrumb-item">Index</div>
        </div>
    </div>
    <div class="section-body">

		<div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="section-title">Hasil</h2>
            </div>
            <div class="d-flex align-items-center">
				<form action="{{ route('task.result.filter') }}" class="d-inline-block mr-3">
					<div class="d-flex align-items-center">
						<input type="text" name="filter_date" id="filter-date" 
						readonly value="{{ $date }}"
						class="form-control mr-3 datepicker bg-white">
						<button type="submit" class="btn btn-primary">Filter</button>
					</div>
				</form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Siklus</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Alat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taskResults as $result)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $result->user->name }}</td>
										<td>{{ $result->cycle->name }}</td>
										<td>{{ $result->created_at->translatedformat('l, d F Y') }}</td>
										<td>{{ $result->tool->name }}</td>
										<td>
											<a href="{{ route('task.result.detail', $result->id) }}" class="btn btn-sm btn-outline-primary">
												Detail
											</a>
											<a href="{{ route('task.result.pdf', $result->id) }}" 
												target="_blank"
												class="btn btn-sm btn-outline-success">
												PDF
											</a>
										</td>
									</tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@push('scripts')
<script>
	$('.datepicker').datepicker({
		format:'dd-mm-yyyy',
		autoclose: true
	});

	$(document).on('change', '#filter-date', function () {  
		let val = $(this).val()
		$('#pdf-date').val(val)
	})
</script>

@endpush