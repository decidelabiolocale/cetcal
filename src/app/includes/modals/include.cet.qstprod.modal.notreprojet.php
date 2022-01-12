<div class="modal fade" tabindex="-1" id="modal-cet-notre-projet" role="dialog" style="display: none;">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 80% !important;">
    <div class="modal-content">
      <div class="modal-header cet-bloc">
        <h5 class="modal-title cet-qstprod-label-text"><?= CetQstprodConstTextes::notre_projet_titre; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="cet-qstprod-label-text"><?= CetQstprodConstTextes::notre_projet_debut; ?></p>
        <ul>
          <li class="cet-qstprod-label-text"><?= CetQstprodConstTextes::notre_projet_priorite_1; ?></li>
          <li class="cet-qstprod-label-text notre-projet-ul-li"><?= CetQstprodConstTextes::notre_projet_priorite_2; ?></li>
          <li class="cet-qstprod-label-text notre-projet-ul-li"><?= CetQstprodConstTextes::notre_projet_priorite_3; ?></li>
          <li class="cet-qstprod-label-text notre-projet-ul-li"><?= CetQstprodConstTextes::notre_projet_priorite_4; ?>
            <ul>
              <li class="cet-qstprod-label-text notre-projet-ul-li"><?= CetQstprodConstTextes::notre_projet_priorite_4_a; ?></li>
              <li class="cet-qstprod-label-text notre-projet-ul-li"><?= CetQstprodConstTextes::notre_projet_priorite_4_b; ?></li>
            </ul>
          </li>
        </ul>
        <?php //include $PHP_INCLUDES_PATH.'modals/include.cet.qstprod.carousel.modal.notreprojet.php'; ?>
        <!--<br>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal"><?= CetQstprodConstLibelles::modal_compris; ?></button>
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-success" id="modal-cet-notre-projet-btn" data-toggle="modal" data-target="#modal-cet-notre-projet" hidden="hidden"></button>