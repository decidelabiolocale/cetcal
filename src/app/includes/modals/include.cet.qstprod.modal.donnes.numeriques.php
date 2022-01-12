<div class="modal fade" tabindex="-1" id="modal-cet-vos-donnees" role="dialog" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title cet-qstprod-label-text">Vos données numériques sont en sécurité</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="cet-qstprod-label-text">Afin de sécuriser vos données référencées sur notre annuaire, nous nous engageons à :</p>
        <ul>
          <li class="cet-qstprod-label-text">Vous fournir vos données quand vous le souhaitez.<br>Pour cela, contactez nous.</li>
          <li class="cet-qstprod-label-text">De supprimer toutes vos données sur votre demande, sans conditions et à tout moment.</li>
          <li class="cet-qstprod-label-text">De vous donner un accès rapide à vos données et cela en consultation et modification.</li>
        </ul>
        <p class="cet-qstprod-label-text">N'hésitez pas à nous contacter depuis notre page d'accueil. Rubrique "Qui sommes nous ?".</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal"><?= CetQstprodConstLibelles::modal_compris; ?></button>
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-success" id="modal-cet-vos-donnees-btn" data-toggle="modal" data-target="#modal-cet-vos-donnees" hidden="hidden"></button>