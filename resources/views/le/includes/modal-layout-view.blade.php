<div class="modal fade centered-modal" id="layout-{{ $l->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog-img modal-dialog-centered" role="document">
    <div class="modal-content-img">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-lg">
          {{-- <span aria-hidden="true">&times;</span> --}}
          X
        </button>

        <div class="text-center">


          @if(pathinfo($l->filename, PATHINFO_EXTENSION) == 'jpg' || pathinfo($l->filename, PATHINFO_EXTENSION) == 'jpeg')
            <img src="{{ asset('/uploads/layouts/' . $l->filename) }}" class="img-responsvie">
          @else
            <a href="{{ asset('/uploads/layouts/'. $l->filename) }}" target="_blank" class="btn btn-success btn-lg">View PDF: {{ $l->filename }}</a>
          @endif
          
          <p><strong>{{ $l->filename }}</strong></p>

        </div>

      </div>

    </div>
  </div>
</div>