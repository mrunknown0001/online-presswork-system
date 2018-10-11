<div class="modal fade" id="denyArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Deny Article</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="#" method="POST" autocomplete="off">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $article->id }}">
          <div class="form-group">
            <label>Comment</label>
            <textarea name="comment" id="comment" class="form-control" placeholder="Add Comment" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-warning">Deny Article</button>
          </div>
        </form>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>