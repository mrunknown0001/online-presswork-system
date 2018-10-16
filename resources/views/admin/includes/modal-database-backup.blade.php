<div class="modal fade" id="databaseBackup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Backup Database</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.backup.database.post') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Backup Database</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>