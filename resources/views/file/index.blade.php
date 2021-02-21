@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>File</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">File</a></div>
            <div class="breadcrumb-item">Index</div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="section-title">File</h2>
            </div>
            <div><button type="button" class="btn btn-primary btn-add">Tambah File</button></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($files as $file)
                                <tr>
                                    <td>{{ (($files->currentPage() - 1 ) * $files->perPage() ) + $loop->iteration }}
                                    </td>
                                    <td><a href="{{ asset('uploads/files/'.$file->file) }}">{{ $file->name }}</a></td>
                                    <td>
                                        <a href="#" data-id="{{ $file->id }}" class="btn btn-delete btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <x-empty-view />
                                </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {{ $files->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('file.modal')

@endsection


@push('scripts')
<script>
    $('.btn-add').on('click', function() {
        resetForm();
        resetError();
        $('#file-modal').modal('show');
    });

    $(document).on('click', '.btn-edit', function() {
        resetForm();
        resetError();
        const file = $(this).data('file');
        $('#id').val(file.id)
        $('#name').val(file.name)
        $('#file-modal').modal('show');
    });


    $('form#file-form').submit( async function( e ) {
        e.preventDefault();
        resetError();
        setLoading();

        var form_data = new FormData( this );
        var url = BASE_URL+'/file';
        var response = await createOrUpdate(url, form_data);
        if(response.status == 'success') {
            alertSuccess(response.message, response.url);
        } else {
            hideLoading()
            if (response.status == '422') {
                $('.error-file').text(response.message.file ? response.message.file[0] : '')
            }
        }
    });

    $(document).on('click', '.btn-delete', function(e){
        event.preventDefault()
        var id = $(this).data("id")
        var url = BASE_URL+'/file/'+id+'/delete';
       deleteConfirmation(url);
    });

    function resetForm() {
        $('#id').val('');
        $('#name').val('');
    }

    function resetError(){
        $('.error-name').text('')
    }

    function readURL(input) {
        $('#label-file').text(input.files[0].name);
    }
</script>
@endpush