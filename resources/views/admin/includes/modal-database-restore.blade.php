<div class="modal fade" id="databaseRestore" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Restore Database</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Upload SQL File to Restore</label>
            <input type="file" name="database" id="database" class="form-control" placeholder="Upload File" accept=".sql">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-warning"><i class="fa fa-upload"></i> Restore Database</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>