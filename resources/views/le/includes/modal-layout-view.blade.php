<div class="modal fade centered-modal" id="layout-{{ $l->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="text-center">
          <img src="{{ asset('/uploads/layouts/' . $l->filename) }}" class="img-responsvie">
          <p><strong>{{ $l->filename }}</strong></p>
        </div>

      </div>

    </div>
  </div>
</div>