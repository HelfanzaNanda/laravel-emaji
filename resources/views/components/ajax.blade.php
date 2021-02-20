<script>
    function deleteConfirmation(url) {
        Swal.fire({
            title: 'Apakah kamu yakin untuk menghapus?',
            text: "Data ini tidak bisa dikebalikan lagi",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then(result => {
            if (result.isConfirmed) {
                deleteData(url);
            }
        })
    }

    function alertSuccess(message, url){
        setTimeout(function() {
            hideLoading()
            Swal.fire({
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 1500
            }).then( ()=> window.location.replace(url));
        }, 500);
    }

    function alertError(message){
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: message
        });
    }

    function createOrUpdate(url, form_data){
        return $.ajax({
            type: 'post',
            url: url,
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
        });
    }

    function deleteData(url){
        $.ajax({
            type: 'get',
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {
            
            },
            success: function(res) {
                res.status == 'success' ? alertSuccess(res.message, res.url) : alertError(res.message)
            }
        })
    }

</script>