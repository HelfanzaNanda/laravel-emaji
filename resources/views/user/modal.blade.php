<div class="modal fade" tabindex="-1" role="dialog" id="user-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form id="user-form" method="post" action="#">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <input type="hidden" name="id" id="id">
                    <span class="text-danger error-name"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                    <span class="text-danger error-email"></span>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="" selected disabled>Pilih Role</option>
                        <option value="penguji">Penguji</option>
                        <option value="pengawas">Pengawas</option>
                    </select>
                    <span class="text-danger error-role"></span>
                </div>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary loading"
                data-loading-text='<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...'>
                  Submit
                </button>
              </div>
          </form>
      </div>
    </div>
</div>