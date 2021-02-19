@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">User</a></div>
            <div class="breadcrumb-item">Index</div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="section-title">User</h2>
            </div>
            <div><button type="button" class="btn btn-primary btn-add">Tambah User</button></div>
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
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $loop->iteration }}
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="#" data-user="{{ $user }}"
                                        class="btn btn-edit btn-sm btn-outline-warning mr-2">
                                        <i class="fas fa-edit"></i></a>
                                        <a href="#" data-id="{{ $user->id }}" class="btn btn-delete btn-sm btn-outline-danger"><i
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

                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.modal')

@endsection


@push('scripts')
<script>
    $('.btn-add').on('click', function() {
        resetForm();
        resetError();
        $('#user-modal').modal('show');
    });

    $(document).on('click', '.btn-edit', function() {
        resetForm();
        resetError();
        const user = $(this).data('user');
        $('#id').val(user.id)
        $('#name').val(user.name)
        $('#email').val(user.email)
        $('#role').val(user.role)
        $('#user-modal').modal('show');
    });


    $('form#user-form').submit( async function( e ) {
        e.preventDefault();
        resetError();
        setLoading();

        var form_data = new FormData( this );
        var url = BASE_URL+'/user';
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
        var url = BASE_URL+'/user/'+id+'/delete';
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

//     $(document).on('click', '#delete', function(e){
//     event.preventDefault()
//     var id = $(this).data("id")

//     swal({
//             title: 'Apakah kamu yakin untuk menghapus?',
//             text: "Data ini tidak bisa dikebalikan lagi",
//             type: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             cancelButtonText: 'Batal',
//             confirmButtonText: 'Hapus'
//         }, function(){
//           $.ajax({
//             type: 'get',
//             url: BASE_URL+'/user/'+id+'/delete',
//             cache: false,
//             contentType: false,
//             processData: false,
//             dataType: 'json',
//             beforeSend: function() {
              
//             },
//             success: function(msg) {
//               if(msg.status == 'success'){
//                   setTimeout(function() {
                    
//                       swal({
//                           title: "sukses",
//                           text: msg.message,
//                           type:"success",
//                           html: true
//                       }, function() {
//                           $('#main-table').DataTable().ajax.reload(null, false);
//                       });
//                   }, 500);
//               } else {
//                   swal({
//                       title: "Gagal",
//                       text: msg.message,
//                       showConfirmButton: true,
//                       confirmButtonColor: '#0760ef',
//                       type:"error",
//                       html: true
//                   });
//               }
//             }
//           })
//         })
//   });
</script>
@endpush