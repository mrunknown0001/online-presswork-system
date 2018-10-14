<div class="modal fade centered-modal" id="layout-{{ $l->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog-img modal-dialog-centered" role="document">
    <div class="modal-content-img">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-lg">
          {{-- <span aria-hidden="true">&times;</span> --}}
          X
        </button>
        

        <div class="text-center">
          <img src="{{ asset('/uploads/layouts/' . $l->filename) }}" class="img-responsvie">
          <p><strong>{{ $l->filename }}</strong></p>
          @if($l->eic_approved != 1)
            <a href="{{ route('eic.approve.layout', ['id' => $l->id]) }}" class="btn btn-primary">Approve</a>
            <a class="btn btn-warning">Deny</a>
          @endif
        </div>

      </div>


    </div>
  </div>
</div>