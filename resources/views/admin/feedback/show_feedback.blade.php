{{-- attachment modal --}}
<div class="modal fade" id="feedbackModal{{ $feedback->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <p>{!! $feedback->feedback !!}</p>
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>