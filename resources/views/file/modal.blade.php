<div class="modal fade" tabindex="-1" role="dialog" id="file-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form id="file-form" method="post" action="#" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah File</h5>
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
                  <label>File</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file" accept="application/pdf" onchange="readURL(this)">
                    <label class="custom-file-label" id="label-file" for="file">Pilih File...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                  <span class="text-danger error-file"></span>
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