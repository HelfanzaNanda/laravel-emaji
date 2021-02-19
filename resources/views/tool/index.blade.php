@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Alat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Alat</a></div>
            <div class="breadcrumb-item">Index</div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="section-title">Alat</h2>
            </div>
            <div><button type="button" class="btn btn-primary btn-add">Tambah Alat</button></div>
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
                                @forelse ($tools as $tool)
                                <tr>
                                    <td>{{ (($tools->currentPage() - 1 ) * $tools->perPage() ) + $loop->iteration }}
                                    </td>
                                    <td>{{ $tool->name }}</td>
                                    <td><img class="btn-img" data-tool="{{ $tool }}" 
                                        src="{{ $tool->image }}" alt="{{ $tool->name }}" 
                                        width="50" height="50" style="cursor: pointer">
                                    </td>
                                    <td>
                                        <a href="#" data-tool="{{ $tool }}" class="btn btn-edit btn-sm btn-outline-warning mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" data-id="{{ $tool->id }}" class="btn btn-delete btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <x-empty-view />
                                </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {{ $tools->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('tool.modal')

@endsection


@push('scripts')
<script>
    $('.btn-add').on('click', function() {
        resetForm();
        resetError();
        $('#tool-modal').modal('show');
    });

    $(document).on('click', '.btn-img', function() {
        const tool = $(this).data('tool');
        $('#preview-img-title').text(tool.name)
        $('#preview-img').attr("src", tool.image).attr("alt", tool.name)
        $('#img-modal').modal('show');
    });

    $(document).on('click', '.btn-edit', function() {
        resetForm();
        resetError();
        const tool = $(this).data('tool');
        $('#id').val(tool.id)
        $('#name').val(tool.name)
        $('#preview-image').attr("src", tool.image).attr("alt", tool.name)
        $('#tool-modal').modal('show');
    });


    $('form#tool-form').submit( async function( e ) {
        e.preventDefault();
        resetError();
        setLoading();

        var form_data = new FormData( this );
        var url = BASE_URL+'/tool';
        var response = await createOrUpdate(url, form_data);
        if(response.status == 'success') {
            alertSuccess(response.message);
        } else {
            hideLoading()
            if (response.status == '422') {
                $('.error-name').text(response.message.name ? response.message.name[0] : '')
                $('.error-image').text(response.message.image ? response.message.image[0] : '')
            }
        }
    });

    $(document).on('click', '.btn-delete', function(e){
        event.preventDefault()
        var id = $(this).data("id")
        var url = BASE_URL+'/tool/'+id+'/delete';
       deleteConfirmation(url);
    });

    function resetForm() {
        $('#id').val('');
        $('#name').val('');
        $('#image').val('');
    }

    function resetError(){
        $('.error-name').text('')
        $('.error-image').text('')
    }
</script>
@endpush