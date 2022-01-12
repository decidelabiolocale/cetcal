<div id="cet-admin-geoloc-accordion">
  <div class="card cet-accordion-admin">
    <div class="card-header" id="cet-admin-geoloc-heading">
      <label class="cet-formgroup-container-label"><small class="form-text">
        Cette section vous aidera à forcer la géolocalisation des entités et producteurs.
      </small></label>
      <h5 class="mb-0">
        <a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-admin-geoloc" aria-expanded="true" aria-controls="cet-admin-geoloc">
            Forcer la géolocalisation d'un Producteur ou d'une entité.
        </a>
        <a class="align-middle" href="#" data-toggle="collapse" 
            data-target="#cet-admin-geoloc" aria-expanded="true" 
            aria-controls="cet-admin-geoloc">
            <i id="cet-accordion-icon-admin-main-1" class="fa fa-hand-o-down cet-accordion-icon"></i>
        </a>
      </h5>
    </div>

    <!-- Bloc collasable -->
    <div id="cet-admin-geoloc" class="collapse" aria-labelledby="cet-admin-geoloc-heading" 
      data-parent="#cet-admin-geoloc-accordion">
      <!-- Formulaire de certification BIO/AB -->
      <div class="card-body cet-accordion-admin-critique">

        <form class="form" 
          id="admin-geoloc-form-prd"
          action="/src/app/controller/cet.annuaire.controller.administration.actions.php?sitkn=<?=$cetcal_session_id;?>" method="post">
          <!-- le premier input hidden déffini l'action, en dure. -->
          <input name="admin_action_cible" id="admin_action_cible" type="text" hidden="hidden" value="admin-geoloc-prd">
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text"><b><u>GEOLOCALISATION dédiée aux producteurs : </u></b><br>N° du producteur pour mise à jour de géolocalisation :</small></label>
            <input class="form-control" 
              id="producteur-geoloc-pkproducteur" 
              name="producteur-geoloc-pkproducteur" type="text" value="" maxlength="8"
              placeholder="Le numéro à saisir correspond au numéro producteur (exemple : 123)"
              onkeyup="updateNomFermePourGeoloc();">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Nom/descriptif ferme :</small></label>
            <input class="form-control" name="producteur-geoloc-nomferme" id="producteur-geoloc-nomferme" 
              type="text" value="" maxlength="512"
              placeholder="Renseigné automatiquement sur la base du n° producteur"
              disabled="disabled">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Coordonnées de géolocalisation du producteur :</small></label>
            <input class="form-control" name="producteur-geoloc-coordonnees" type="text" 
              value="" maxlength="256"
              placeholder="Les coordonnées copier depuis Google maps (autre) et avec séparateur 'point virgule' ou ' virgule'">
          </div>
          <!-- END contenu du formulaire -->
          <button class="btn cet-navbar-btn" id="btn-admin-geoloc-prd" type="submit" 
            style="float: right; margin-right: 4px;">
            Valider la géoloc producteur
          </button>
        </form>

        <form class="form" 
          id="admin-geoloc-form-entite"
          action="/src/app/controller/cet.annuaire.controller.administration.actions.php?sitkn=<?=$cetcal_session_id;?>" method="post">
          <!-- le premier input hidden déffini l'action, en dure. -->
          <input name="admin_action_cible" id="admin_action_cible" type="text" hidden="hidden" value="admin-geoloc-entite">
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text"><b><u>GEOLOCALISATION dédiée aux entités (marchés, amaps, assos, magasins...) : </u></b><br>N° de l'entité pour mise à jour de géolocalisation (# dans le tableau admin) :</small></label>
            <input class="form-control" 
              id="entite-geoloc-pkentite"
              name="entite-geoloc-pkentite" type="text" value="" maxlength="8"
              placeholder="Le numéro à saisir correspond au numéro de l'entité (exemple : 123, # dans le tableau admin)"
              onkeyup="updateDenominationEntitePourGeoloc();">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Dénomination/descriptif entité :</small></label>
            <input class="form-control" name="entite-geoloc-denomination" id="entite-geoloc-denomination" 
              type="text" value="" maxlength="512"
              placeholder="Sera renseigné automatiquement sur la base du n° entité"
              disabled="disabled">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Coordonnées de géolocalisation de l'entité :</small></label>
            <input class="form-control" name="entite-geoloc-coordonnees" type="text" value="" maxlength="256"
              placeholder="Les coordonnées copier depuis Google maps (autre) et avec séparateur 'point virgule' ou ' virgule'">
          </div>
          <!-- END contenu du formulaire -->
          <button class="btn cet-navbar-btn" id="btn-admin-geoloc-entite" type="submit" 
            style="float: right; margin-right: 4px;">
            Valider la géoloc entité
          </button>
        </form>

      </div>
    </div>
    <!-- END Bloc collasable -->
  </div>
</div>