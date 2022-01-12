<div class="modal" tabindex="-1" id="modal-questionaire" role="dialog" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-questionaire-titre"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modal-questionaire-paragraphe"></p>
        <p id="modal-questionaire-paragraphe-bis"></p>
        <p id="modal-questionaire-paragraphe-ter"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" id="modal-questionaire-btn-primary" data-dismiss="modal"></button>
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-success" id="modal-questionaire-btn" data-toggle="modal" data-target="#modal-questionaire" hidden="hidden" onclick="$('#modal-questionaire').fadeIn('slow');"></button>