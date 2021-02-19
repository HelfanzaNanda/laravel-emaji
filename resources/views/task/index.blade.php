@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pertanyaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pertanyaan</a></div>
            <div class="breadcrumb-item">Index</div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="section-title">Pertanyaan</h2>
            </div>
            <div><a href="{{ route('task.create') }}" type="button" class="btn btn-primary">Tambah Pertanyaan</a></div>
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                <tr>
                                    <td>{{ (($tasks->currentPage() - 1 ) * $tasks->perPage() ) + $loop->iteration }}
                                    </td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->email }}</td>
                                    <td>{{ $task->role }}</td>
                                    <td>
                                        <a href="#" data-task="{{ $task }}"
                                        class="btn btn-edit btn-sm btn-outline-warning mr-2">
                                        <i class="fas fa-edit"></i></a>
                                        <a href="#" data-id="{{ $task->id }}" class="btn btn-delete btn-sm btn-outline-danger"><i
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

                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>

    $(document).on('click', '.btn-edit', function() {
        resetForm();
        resetError();
        const task = $(this).data('task');
        $('#id').val(task.id)
        $('#name').val(task.name)
        $('#email').val(task.email)
        $('#role').val(task.role)
        $('#task-modal').modal('show');
    });


    $('form#task-form').submit( async function( e ) {
        e.preventDefault();
        resetError();
        setLoading();

        var form_data = new FormData( this );
        var url = BASE_URL+'/task';
        var response = await createOrUpdate(url, form_data);
        if(response.status == 'success') {
            alertSuccess(response.message);
        } else {
            hideLoading()
            if (response.status == '422') {
                $('.error-name').text(response.message.name ? response.message.name[0] : '')
                $('.error-email').text(response.message.email ? response.message.email[0] : '')
                $('.error-role').text(response.message.role ? response.message.role[0] : '')
            }
        }
    });

    $(document).on('click', '.btn-delete', function(e){
        event.preventDefault()
        var id = $(this).data("id")
        var url = BASE_URL+'/task/'+id+'/delete';
       deleteConfirmation(url);
    });

    function resetForm() {
        $('#id').val('');
        $('#name').val('');
        $('#email').val('');
        $('#role').val('');
    }

    function resetError(){
        $('.error-name').text('')
        $('.error-email').text('')
        $('.error-role').text('')
    }
</script>
@endpush