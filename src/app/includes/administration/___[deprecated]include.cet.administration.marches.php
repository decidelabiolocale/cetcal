<div id="cet-admin-1-accordion">
  <div class="card cet-accordion-admin">
  	<div class="card-header" id="cet-admin-1-heading">
  	  <label class="cet-formgroup-container-label"><small class="form-text">
  	  	Cette section vous aidera à administrer les marchés et lieux de distribution.
  	  </small></label>
      <h5 class="mb-0">
      	<a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-admin-1" aria-expanded="true" aria-controls="cet-admin-1">
            Administrer les marchés.
  	    </a>
      	<a class="align-middle" href="#" data-toggle="collapse" 
        		data-target="#cet-admin-1" aria-expanded="true" 
        		aria-controls="cet-admin-1">
        		<i id="cet-accordion-icon-admin-main-1" class="fa fa-hand-o-down cet-accordion-icon"></i>
      	</a>
  	  </h5>
    </div>

    <!-- Bloc collasable -->
    <div id="cet-admin-1" class="collapse" aria-labelledby="cet-admin-1-heading" data-parent="#cet-admin-1-accordion">
      
      <!-- Card Formulaire d'ajout de marché -->
      <div class="card-body">
        <form class="form" id="admin-marche-form" action="/src/app/controller/cet.annuaire.controller.administration.actions.php?sitkn=<?=$cetcal_session_id;?>" method="post">
          <!-- le premier input hidden déffini l'action, en dure. -->
          <input name="admin_action_cible" id="admin_action_cible" type="text" hidden="hidden" value="insert-marche">
          <label class="cet-formgroup-container-label"><small class="form-text">Ajouter un marché :</small></label>
          <!-- contenu du formulaire, reflet de la table cetcal_entite pour les marches -->
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Dénomination :</small></label>
            <input class="form-control" name="entite-marche-denomination" type="text" value="" maxlength="128">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Territoire :</small></label>
            <input class="form-control" name="entite-marche-territoire" type="text" value="" maxlength="64">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Activite :</small></label>
            <textarea class="form-control" name="entite-marche-activite" form="admin-marche-form" maxlength="512" placeholder="Description de l'activité de ce marché... Quels sont les produteurs présents ? Peut-on y manger ou y boire un café ? Des recommandations ?"></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Adresse :</small></label>
            <input class="form-control" name="entite-marche-adresse" type="text" value="" maxlength="256">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">N° de téléphone associé :</small></label>
            <input class="form-control" name="entite-marche-tel" type="text" value="" maxlength="45">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Personne à contacter :</small></label>
            <input class="form-control" name="entite-marche-personne" type="text" value="" maxlength="45">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Email de contact :</small></label>
            <input class="form-control" name="entite-marche-email" type="email" value="" maxlength="64">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Adresse de site web ou page de réseau social :</small></label>
            <input class="form-control" name="entite-marche-urlwww" type="text" value="" maxlength="256">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Informations liées aux commandes :</small></label>
            <textarea class="form-control" name="entite-marche-infoscmd" form="admin-marche-form" maxlength="512" placeholder="Description des informations liées aux commandes... Certains producteurs peuvent êtres contacté à l'avance pour passer commande."></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Jours et/ou horaires :</small></label>
            <textarea class="form-control" name="entite-marche-jourhoraire" form="admin-marche-form" maxlength="512" placeholder="Description des jours et horaires de ce marché... Mais aussi Parkings ? Journées non programmées."></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Spécificités :</small></label>
            <textarea class="form-control" name="entite-marche-specificites" form="admin-marche-form" maxlength="512" placeholder="Description des spécificités liées à ce marché..."></textarea>
          </div>
          <!-- END contenu du formulaire -->
          <button class="btn btn-warning" type="submit" id="btn-admin-ajout-marche" style="float: right;">
            Ajouter ce marché
          </button>
        </form>
        <!-- End Formulaire -->
      </div>
      <!-- END Card Formulaire d'ajout de marché -->
      
      <hr>

      <!-- Listing des marchés pour mises à jour -->
      <div class="card-body">
        <!-- Start Formulaire -->
        <form class="form" action="/src/app/controller/cet.annuaire.controller.administration.actions.php" method="post">
          <!-- le premier input hidden déffini l'action, en dure. -->
          <input name="admin_action_cible" id="admin_action_cible" type="text" hidden="hidden" value="marcheslieux">
          <?php
            require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.marches.castillonnais.php');
            $ctrl = new MarchesCastillonnaisController();
            $data_marches = $ctrl->selectAllByType('marche');
          ?>

          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Dénomination</th>
                <th scope="col">Adresse</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data_marches as $data): ?>
                <tr class="admin-marche-administrer">
                  <th scope="row" class="pk"><?=$data['pk_entite'];?></th>
                  <td><?=$data['denomination'];?></td>
                  <td><?=$data['adresse'];?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </form>
        <!-- End Formulaire -->
      </div>
      <!-- END Listing des marchés pour mises à jour -->

    </div>
    <!-- ENDa Bloc collasable -->

  </div>
</div>