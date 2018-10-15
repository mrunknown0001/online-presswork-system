<div class="modal fade" id="deactivateActivity-{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong> Deactivate Activity </strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <p>Activity Title: <strong>{{ ucwords($a->title) }}</strong></p>
       <hr>
       <p>Are you sure you want to deactivate this activity?</p>

       <form action="{{ route('eic.deactivate.activity.post') }}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $a->id }}">
          <div class="form-group">
            <button type="submit" class="btn btn-danger">Deactivate Activity</button>
          </div>
       </form>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>