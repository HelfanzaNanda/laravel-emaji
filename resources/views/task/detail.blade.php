@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ $tool->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pertanyaan</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex justify-content-between align-items-center">
            <div class="mr-2">
                <h2 class="section-title">{{ $tool->name }}</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @foreach ($tool->tasks as $task)
                        <table class="table">
                            <div class="d-flex align-items-center justify-content-between">
                                <div><h6>{{'Siklus : '. $task->taskCycleItems()->get()->implode('cycle.name', ', ') }}</h6></div>
                                <div><button data-tool-id="{{ $task->id }}" class="btn btn-delete btn-danger">delete</button></div>
                            </div>
                            <tbody>
                                @foreach ($task->taskItems as $item)
                                    <tr>
                                        <td width="5">{{ $loop->iteration }}
                                        </td>
                                        <td>{{ $item->body }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>

    $(document).on('click', '.btn-delete', function(e){
        event.preventDefault()
        var toolId = $(this).data("tool-id")
        var url = BASE_URL+'/task/'+toolId+'/delete';
       deleteConfirmation(url);
    });

</script>
@endpush