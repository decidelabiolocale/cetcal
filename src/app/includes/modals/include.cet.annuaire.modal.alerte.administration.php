<div class="modal" tabindex="-1" id="cet-modal-alerte" role="dialog" style="display: none;">
  <div class="modal-dialog" role="document" style="max-width: 64% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cet-modal-alerte-titre"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="cet-modal-alerte-paragraphe"></p>
        <p id="cet-modal-alerte-paragraphe-bis"></p>
        <p id="cet-modal-alerte-paragraphe-ter"></p>
        <p id="cet-modal-alerte-paragraphe-quater"></p>
        <p id="cet-modal-alerte-paragraphe-quinquies"></p>
        <p id="cet-modal-alerte-paragraphe-sexies"></p>
        <p id="cet-modal-alerte-paragraphe-septies"></p>
        <div class="form-group mb-3" id="commentaire-action-admin-container" style="display: none;">
          <label><small>Renseigner un commentaire ou descriptif concernant cette action :</small></label>
          <textarea class="form-control" id="commentaire-action-admin" 
            name="commentaire-action-admin"
            placeholder="Commentaire ou descriptif de l'action"
            value="" maxlength="512"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning btn-sm" id="cet-modal-alerte-btn-annuler" data-dismiss="modal"></button>
        <button type="button" class="btn btn-danger btn-sm" id="cet-modal-alerte-btn-primary" data-dismiss="modal"></button>
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-success" id="cet-modal-alerte-btn" data-toggle="modal" data-target="#cet-modal-alerte" hidden="hidden" onclick="$('#cet-modal-alerte').fadeIn('slow');"></button>