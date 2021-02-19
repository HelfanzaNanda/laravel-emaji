@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pertanyaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pertanyaan</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="section-title">Pertanyaan</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form id="task-form" method="post" action="#">
                    <div class="card">
                        <div class="card-body">
                            @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="cycle_id">Siklus</label>
                                    <select name="cycle_id" id="cycle_id" class="form-control select-multiple" multiple>
                                        @foreach ($cycles as $cycle)
                                        <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-cycle_id"></span>
                                </div>
                                <div class="form-group">
                                    <label for="tool_id">Alat</label>
                                    <select name="tool_id" id="tool_id" class="form-control">
                                        <option value="" selected disabled>Pilih Alat</option>
                                        @foreach ($tools as $tool)
                                        <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-tool_id"></span>
                                </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body task-items">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="body">Pertanyaan</label>
                                <button type="submit" class="d-inline btn btn-light btn-add-row"> Tambah Row </button>
                            </div>
                            <div class="input-group mb-3">
                                <textarea class="form-control" id="body" name="body[]" style="margin-top: 0px; margin-bottom: 0px; height: 88px;"></textarea>
                                <div class="input-group-append" hidden>
                                    <button class="btn-delete-row btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary loading float-right"
                        data-loading-text='<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...'>
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    })

    $(document).on('click', '.btn-add-row', function(e) {
        e.preventDefault();
        $('.task-items').append(addRow())
    });

    $(document).on('click', '.btn-delete-row', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove()
    })


    function addRow(){
        var cols = ``
            cols += `<div class="input-group mb-3">`
                cols += `<textarea class="form-control" id="body" name="body[]" style="margin-top: 0px; margin-bottom: 0px; height: 88px;"></textarea>`
                cols += `<div class="input-group-append">`
                    cols += `<button class="btn-delete-row btn btn-danger"><i class="fas fa-trash"></i></button>`
                cols += `</div>`
            cols += `</div>`
        return cols
    }

</script>
@endpush