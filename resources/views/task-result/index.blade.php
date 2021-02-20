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
            <div> <h2 class="section-title">Hasil</h2> </div>
            
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
                                    <th scope="col">Foto</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($taskResults as $result)
                                <tr>
                                    <td>{{ (($taskResults->currentPage() - 1 ) * $taskResults->perPage() ) + $loop->iteration }}
                                    </td>
                                    <td>{{ $result->name }}</td>
                                    <td>
                                        <a href="#" data-result="{{ $result }}" class="btn btn-edit btn-sm btn-outline-warning mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" data-id="{{ $result->id }}" class="btn btn-delete btn-sm btn-outline-danger mr-2">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @if (count($result->tasks) > 0)
                                        <a href="{{ route('task.detail', $result->id) }}" class="btn  btn-sm btn-outline-success">
                                            Detail Pertanyaan
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <x-empty-view />
                                </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {{ $taskResults->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@push('scripts')

@endpush