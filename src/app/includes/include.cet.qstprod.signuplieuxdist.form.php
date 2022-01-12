<?php
$neant = "";
$currentForm = isset($_SESSION['signuplieuxdist.form.post']) ? $_SESSION['signuplieuxdist.form.post'] : $neant;
$cntxmdf = isset($_SESSION['CONTEXTE_MODIF-signuplieuxdist']) ? $_SESSION['CONTEXTE_MODIF-signuplieuxdist'] : false;
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.qstprod.controller.signuplieuxdist.php');
$ctrl = new FormLieuDistController();
$dataTypeLieu = $ctrl->fetchAllTypeLieuxDistinctType();
?>

<div class="row justify-content-lg-center" id="qstprod-lieuxdist-root-div">
  <div class="col-lg-6">

    <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signup.entete.form.php'; ?>
    <!-- ------------------------- -->
    <!-- INPUTS formulaire START : ---
    <input class="form-control" id="qstprod-" name="qstprod-" type="text" placeholder="">
    ---- ------------------------- -->
    <br>
    <label class="cet-formgroup-container-label">
      <small class="form-text">Renseignez les lieux de distribution ou de vente :</small>
    </label>
    <div class="cet-formgroup-container">

      <div class="form-group mb-3">
        <label class="cet-input-label"><small class="cet-qstprod-label-text">Veuillez sélectionner le type de lieux de distribution :</small></label>
        <select class="form-control cet-visiui-input-select" id="qstprod-lieuxdist-type">
          <option value="" id="qstprod-lieuxdist-type-null">Choississez un type de lieu de distribution</option>
          <?php foreach ($dataTypeLieu as $data): ?>
            <option value="<?= $data->code_type; ?>" data="<?= $data->sous_type; ?>" 
              visibiliteui="<?= $data->visibilite_ui; ?>"
              opensearch="<?= $data->recherche_tbl_entite; ?>"><?= ucfirst($data->type) ?></option>
          <?php endforeach;?>
        </select>
      </div>
      <div class="form-group mb-3 cet-visiui visiui-sup-0" id="qstprod-lieudist-soustypes-container">
        <label class="cet-input-label">
          <small class="cet-qstprod-label-text">Précisez votre choix</small>
        </label>
        <select class="form-control cet-visiui-input-select" 
          id="qstprod-lieudist-soustypes" name="qstprod-lieudist-soustypes">
          <option value="">Veuillez préciser votre choix</option>
        </select>
      </div>

      <div class="form-group mb-3 cet-visiui visiui-recherche-ta" 
        id="qstprod-recherche-lieuxdist-container" 
        style="display: none;">
        <label class="form-check-label cet-qstprod-label-text" id="qstprod-recherche-label" 
          for="qstprod-recherche-lieuxdist">
          Rechercher votre lieu de distribution :&#160;
        </label>
        <input type="text" class="form-control typeahead cet-visiui-input" placeholder="" aria-label="" 
          id="qstprod-recherche-lieuxdist" name="qstprod-recherche-lieuxdist">
      </div>

      <div class="form-check form-check-inline cet-visiui visiui-recherche-ta" 
        id="cet-lieux-non-trouve-container"
        style="margin-bottom: 8px;">
        <input class="cet-visiui-input-checkbox" type="checkbox" id="cet-lieux-non-trouve" 
          aria-label="">
        <label class="form-check-label cet-qstprod-label-text" id="qstlieudist-1-label" 
          for="cet-lieux-non-trouve">
          &#160;Aucun élément trouvé dans la recherche
        </label>
      </div>

      <div class="ml-5">
        <div class="form-group mb-3 cet-visiui cet-crea-entite visiui-sup-8">
          <label for="qstlieudist-3">
            <small class="cet-qstprod-label-text">Entrez le nom de ce lieu de distrubution : </small>
          </label>
          <input type="text" class="form-control cet-visiui-input" name="nv-marche-lieuxdist-nom"
            id="nv-marche-lieuxdist-nom" placeholder="Entrez le nom de ce lieu">
          <small class="nouveau-marche-error-message"></small>
        </div>
        <div class="form-group mb-3 cet-visiui cet-crea-entite visiui-sup-8">
          <label for="qstlieudist-3-1">
            <small class="cet-qstprod-label-text">Entrez l'adresse complète de ce lieu de distribution : </small>
          </label>
          <input type="text" class="form-control cet-visiui-input" name="nv-marche-lieuxdist-adr"
            id="nv-marche-lieuxdist-adr" placeholder="Adresse complète">
          <small class="nouveau-marche-error-message"></small>
        </div>
        <div class="form-group mb-3 cet-visiui cet-crea-entite visiui-sup-8">
          <label for="qstlieudist-3-1">
            <small class="cet-qstprod-label-text">Jour de présence à ce lieu (marché, AMAP...) : </small>
          </label>
          <select class="form-control cet-visiui-input-select" id="timeInput-jour" name="timeInput-jour" 
            style="max-width: 256px;">
            <option value="">Sélectionner un jour</option>
            <?php foreach ($listes_arrays->marches_jours as $jour): ?>
              <option value="<?= $jour[1]; ?>"><?= $jour[1]; ?></option>
            <?php endforeach;?>
          </select>
          <small class="nouveau-marche-error-message"></small>
        </div>
        <div class="form-group mb-3 cet-visiui cet-crea-entite visiui-sup-16">
          <label for="qstlieudist-3-1">
            <small class="cet-qstprod-label-text">Heure de début de votre présence : </small>
          </label>
          <input class="form-control cet-visiui-input" type="text" id="timeInput-heure-deb" 
            name="timeInput-heure-deb" data-time-format="H:i"
            style="max-width: 256px;" />
          <small class="nouveau-marche-error-message"></small>
        </div>
        <div class="form-group mb-3 cet-visiui cet-crea-entite visiui-sup-16">
          <label for="qstlieudist-3-1">
            <small class="cet-qstprod-label-text">Heure de fin présence : </small>
          </label>
          <input class="form-control cet-visiui-input" type="text" id="timeInput-heure-fin" 
            name="timeInput-heure-fin" 
            data-time-format="H:i"
            style="max-width: 256px;" />
          <small class="nouveau-marche-error-message"></small>
        </div>
        <div class="form-group mb-3 cet-visiui cet-crea-entite visiui-sup-16">
          <label for="qstlieudist-3-1">
            <small class="cet-qstprod-label-text">Date de présence sur ce marché (pour les marchés événementiels uniquement) : </small>
          </label>
          <input data-toggle="datepicker" class="form-control cet-visiui-input" type="text" 
            id="timeInput-date" name="timeInput-date"
            style="max-width: 256px;">
          <div data-toggle="datepicker"></div>
          <small class="nouveau-marche-error-message"></small>
        </div>
      </div>

      <div class="form-group mb-3 cet-visiui visiui-recherche-ta" style="margin-top: 12px;">
        <label for="qstprod-precisions-prod" name="qstlieudist-4"><i class="fas fa-question-circle"></i>&#160;&#160;Précisions liée à votre présence sur ce lieu de distribution :</label>
        <textarea class="form-control cet-visiui-input-textarea" name="qstlieudist-4" id="qstprod-precisions-prod" maxlength="256" rows="3"></textarea>
        <p class="limit-text-alert" 
          style="margin-left: 4px; margin-top: 2px; font-size: 14px;">
<!--          Aucune saisie pour le moment.
-->        </p>
        <div class="d-flex justify-content-end">
          <button class="btn cet-navbar-btn cet-navbar-btn-small" id="add-lieuxdist-au-recap">Ajouter ce lieu de distribution</button>
        </div>
      </div>

      <div id="lieux-dist-recap-avant-envoi" style="display: none;">
        <p style="margin-bottom: -12px;"><small>Récapitulatif de vos lieux de distributions :</small></p>
        <hr>
        <div id="lieux-dist-recap-liste"></div>
      </div>

    </div> <!-- end container -->

    <!--DEBUT FORM POST-->
    <form id="signuplieuxdist.form" class="form" method="post"
      action="/src/app/controller/cet.qstprod.controller.signuplieuxdist.form.php">      
      <!-- boutons de control -->
      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <button class="btn cet-navbar-btn" type="submit" 
            onmousedown="$('#qstprod-signuplieuxdist-nav').val('retour');"
            id="btn-signuplieuxdist.form-retour"><?= CetQstprodConstLibelles::form_retour; ?></button>
          <button class="btn cet-navbar-btn" type="submit" 
            onmousedown="$('#qstprod-signuplieuxdist-nav').val('valider');"
            id="btn-signuplieuxdist.form-valider"><?= CetQstprodConstLibelles::form_valider; ?></button>
        </div>
      </div>
      <div id="data" style="display: none;"></div>    
      <input type="text" name="cetcal_session_id" id="cetcal_session_id" 
        value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signuplieuxdist-json" id="qstprod-signuplieuxdist-json"
        value="<?= isset($currentForm['qstprod-signuplieuxdist-json']) ? $currentForm['qstprod-signuplieuxdist-json'] : $neant; ?>" 
        hidden="hidden">

      <input type="text" name="qstprod-signuplieuxdist-nav" id="qstprod-signuplieuxdist-nav" 
        value="unset" hidden="hidden">
    </form>
    <!--FIN FORM POST-->

  </div><!-- fin col -->
</div><!-- fin row -->
<script src="/src/scripts/js/cetcal/classes/lieuxdist/cetcal.class.formvalidator.js"></script>
<script src="/src/scripts/js/cetcal/classes/lieuxdist/cetcal.class.lieudistpost.js"></script>
<script src="/src/scripts/js/cetcal/cetcal.min.signuplieuxdist.js"></script>
<script src="/src/scripts/js/typeahead.0.11.1.min.js" ></script>
<script src="/src/scripts/js/timepicker/jquery.timepicker.min.js"></script>
<script src="/src/scripts/js/cetcal/datepicker.js"></script>