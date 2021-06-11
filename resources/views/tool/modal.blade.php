<div class="modal fade" tabindex="-1" role="dialog" id="tool-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="tool-form" method="post" action="#">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Alat</h5>
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
            <label for="merk">Merk</label>
            <input type="text" class="form-control" name="merk" id="merk">
            <span class="text-danger error-merk"></span>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="image" name="image" accept=".png, .jpg, .jpeg"  onchange="readURL(this)">
              <label class="custom-file-label" id="label-img" for="image">Pilih Foto...</label>
              <img id="preview-image" class="img-fluid my-2" width="50" height="50" style="visibility: hidden">
              <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            <span class="text-danger error-image"></span>
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

<div class="modal fade" tabindex="-1" role="dialog" id="img-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="preview-img-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center">
          <img id="preview-img" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="generate-qrcode-modal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="preview-img-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center">
          {{-- <input type="text" style="width: 20%" id="a-id"> --}}
          <div id="qrcode"></div>
        </div>
      </div>
	  <div class="modal-footer bg-whitesmoke br">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary download-qrcode">
		  Download
		</button>
	  </div>
    </div>
  </div>
</div>