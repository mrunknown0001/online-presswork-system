<div class="modal fade" id="removeSectionEditor-{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Remove Section Editor</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p>Are you sure you want to remove {{ ucwords($s->firstname . ' ' . $s->lastname) }}?</p>

        <form action="{{ route('eic.remove.section.editor.post') }}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $s->id }}">
          <div class="form-group">
            <button type="submit" class="btn btn-danger">Yes, Remove</button>
          </div>
        </form>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>