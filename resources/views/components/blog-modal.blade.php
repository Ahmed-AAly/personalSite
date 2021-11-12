{{-- remove article modal --}}
<div class="modal fade text-white" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePostModalLabel">Delete Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('deleteBlog')}}">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <input type="hidden" id="postID" name="post_id">
                <label for="deleteConfirmation" class="col-form-label">Confirmation:</label>
                <input type="text" name="delete_confirmation" class="form-control" id="deleteConfirmation" required autocomplete="off">
                <small id="deleteConfirmationHelpBlock" class="form-text text-white">
                    Type the work "DELETE" in Uppercase to cofirm your request to delete this post.
                  </small>
            </div>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
