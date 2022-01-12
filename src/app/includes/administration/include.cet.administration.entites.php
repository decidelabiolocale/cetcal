<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/admin/cet.annuaire.controlleur.administration.entites.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.types.php');
$ctrl = new AdminEntitesCastillonnaisController();
?>
<div id="cet-admin-1-accordion">
  <div class="card cet-accordion-admin">
  	<div class="card-header" id="cet-admin-1-heading">
  	  <label class="cet-formgroup-container-label"><small class="form-text">
  	  	Cette section vous aidera à administrer les marchés, les Associations, lieux de distribution, AMAPs etc.
  	  </small></label>
      <h5 class="mb-0">
      	<a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-admin-1" aria-expanded="true" aria-controls="cet-admin-1">
            Administrer les marchés, les Associations, lieux, AMAPs.
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
      
      <!-- Formulaire d'ajout de marché -->
      <div class="card-body cet-accordion-admin-critique">
        <form class="form" id="admin-entite-form" action="/src/app/controller/cet.annuaire.controller.administration.actions.php?sitkn=<?=$cetcal_session_id;?>" method="post">
          <!-- le premier input hidden déffini l'action, en dure. -->
          <input name="admin_action_cible" id="admin_action_cible" type="text" hidden="hidden" value="">
          <input name="admin-pk-entite" id="admin-pk-entite" type="text" hidden="hidden" value="">
          <label class="cet-formgroup-container-label"><small class="form-text">Pour ajouter un marché, remplir le formulaire. Ou bien...<br>Pour administrer, clicker sur un élément dans la liste qui se trouve après le formulaire.</small></label>
          <!-- contenu du formulaire, reflet de la table cetcal_entite pour les entites -->
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Dénomination :</small></label>
            <input class="form-control" name="entite-entite-denomination" id="entite-entite-denomination" type="text" value="" maxlength="128">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Territoire :</small></label>
            <input class="form-control" name="entite-entite-territoire" type="text" value="" maxlength="64">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Activite :</small></label>
            <textarea class="form-control" name="entite-entite-activite" form="admin-entite-form" maxlength="512" placeholder="Description de l'activité de ce marché... Quels sont les produteurs présents ? Peut-on y manger ou y boire un café ? Des recommandations ?"></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Adresse :</small></label>
            <input class="form-control" name="entite-entite-adresse" type="text" value="" maxlength="256">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">N° de téléphone associé :</small></label>
            <input class="form-control" name="entite-entite-tel" type="text" value="" maxlength="45">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Personne à contacter :</small></label>
            <input class="form-control" name="entite-entite-personne" type="text" value="" maxlength="45">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Email de contact :</small></label>
            <input class="form-control" name="entite-entite-email" type="email" value="" maxlength="64">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Adresse de site web ou page de réseau social :</small></label>
            <input class="form-control" name="entite-entite-urlwww" type="text" value="" maxlength="256">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Informations liées aux commandes :</small></label>
            <textarea class="form-control" name="entite-entite-infoscmd" form="admin-entite-form" maxlength="512" placeholder="Description des informations liées aux commandes... Certains producteurs peuvent êtres contacté à l'avance pour passer commande."></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Jours et/ou horaires :</small></label>
            <textarea class="form-control" name="entite-entite-jourhoraire" form="admin-entite-form" maxlength="512" placeholder="Description des jours et horaires de présence... Mais aussi Parkings ? Journées non programmées."></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Spécificités :</small></label>
            <textarea class="form-control" name="entite-entite-specificites" form="admin-entite-form" maxlength="512" placeholder="Description des spécificités..."></textarea>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Type d'entité sélectionné :</small></label>
            <?php $typesEntite = $ctrl->selectAllTypes(); ?>
            <select class="form-control" name="entite-entite-type" id="entite-entite-type">
              <option value="0" selected="selected">-- aucun type sélectionné --</option>
              <?php foreach($typesEntite as $type): ?>
                <?php if (strlen($type['type']) < 4) continue; ?>
                <option value="<?= $type['type']; ?>"><?= CetAnnuaireConstTypes::TYPE_ENTITE[$type['type']]; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- END contenu du formulaire -->
          <a class="btn cet-navbar-btn" id="btn-admin-ajout-entite" 
            style="float: right; margin-right: 4px;">
            Ajouter
          </a>
          <a class="btn cet-navbar-btn" id="btn-admin-modifier-entite" 
            style="float: right; margin-right: 4px; display: none;">
            Modifier
          </a>
          <a class="btn cet-navbar-btn" id="btn-admin-delete-entite" 
            style="float: right; margin-right: 4px; display: none;">
            Supprimer
          </a>
          <a class="btn cet-navbar-btn" id="btn-admin-annuler-entite" 
            style="float: right; margin-right: 4px; display: none;">
            Annuler
          </a>
        </form>
        <!-- END Card Formulaire d'ajout de marché -->
        <?php include $_SERVER['DOCUMENT_ROOT'].'/src/app/includes/administration/include.cet.administration.media.entite.php'; ?>
      </div>  
      <hr>
      <!-- Listing des entités pour mises à jour -->
      <div class="card-body">
        <?php $data_entites = $ctrl->selectAll(); ?>
        <table class="table table-sm cetcal-admin-table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Dénomination</th>
              <th scope="col">Adresse</th>
              <th scope="col">Activité</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_entites as $data): ?>
              <tr class="admin-entite-administrer">
                <td class="pk cetcal-admin-table-td" scope="row" 
                  id="admin-entite-link-<?= $data['pk_entite']; ?>" 
                  data="<?= $data['pk_entite']; ?>" 
                  ent-cible="[entité n°<?= $data['pk_entite']; ?>] <?= $data['denomination']; ?> (adresse: <?= $data['adresse']; ?>).">
                  <?= $data['pk_entite']; ?>
                </td>
                <td class="cetcal-admin-table-td">
                  <?= $data['denomination']; ?>
                </td>
                <td class="cetcal-admin-table-td">
                  <?= $data['adresse']; ?> 
                </td>
                <td class="cetcal-admin-table-td">
                  <?= $data['activite']; ?> 
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- END Listing des entités pour mises à jour -->
    </div>
    <!-- END Bloc collasable -->

  </div>
</div>