<?php
$currentForm = isset($_SESSION['signuplieuxdist.form.post']) ? $_SESSION['signuplieuxdist.form.post'] : array();
$neant = "";
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
?>
<!-- singup lieux de distribution informations html form -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <form id="signuplieuxdist.form" class="form" method="post" 
      action="/src/app/controller/cet.qstprod.controller.signuplieuxdist.form.legacy.php">
      <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signup.entete.form.php'; ?>
      <!-- ------------------------- -->
      <!-- INPUTS formulaire START : ---
      <input class="form-control" id="qstprod-" name="qstprod-" type="text" placeholder="">
      ---- ------------------------- -->
      <br>
      <label class="cet-formgroup-container-label"><small class="form-text">Renseignez les lieux de distribution ou de vente :</small></label>
      <div class="cet-formgroup-container">
        <label><small class="form-text">Vos activités de distribution / vente (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->points_vente_producteurs as $pdv): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $pdv); ?>" id="qstprod-pdv-<?= $counter; ?>" 
            name="qstprod-pdv[]"
            <?= isset($currentForm['qstprod-pdv']) && in_array(implode(';', $pdv), $currentForm['qstprod-pdv']) ? 'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-pdv-<?= $counter; ?>"><?= $pdv[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-pdvautre" name="qstprod-pdvautre" type="text" 
            placeholder="Point de distribution ou vente autre"
            value="<?= isset($currentForm['qstprod-pdvautre']) ? $currentForm['qstprod-pdvautre'] : $neant; ?>"
            maxlength="128">
        </div>
      </div>
      <!-- -------------------------------------- -->
      <!-- ZONE de récap produits.                -->
      <!-- -------------------------------------- -->
      <div class="alert alert-success" role="alert">
        <label class="cet-formgroup-container-label"><small class="form-text">Récapitulatif de vos marchés :</small></label>
        <div id="listing-lieux-marches">
          <label><small class="form-text">Vos marchés : </small></label><br>
        </div>
      </div>

      <label class="cet-formgroup-container-label"><small class="form-text">Sur quels marchés êtes vous présent ?</small></label>
      <div class="cet-formgroup-container">
        <label><small class="form-text">Renseigner vos informations marchés : </small></label>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si marché, préciser l'adresse (ou simplement la commune) :</small></label>   
          <input class="form-control" id="qstprod-adr-marche" name="qstprod-adr-marche" type="text" 
            placeholder="Si marché, preciser"
            value="<?= isset($currentForm['qstprod-adr-marche']) ? $currentForm['qstprod-adr-marche'] : $neant; ?>"
            maxlength="200">
        </div>
        <label><small class="form-text">Si marché, quels jours de présence ?</small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->marches_jours as $jour): ?>
        <div class="form-check" id="checkboxes-lieux-jours-marche">
          <input class="form-check-input qstprod-lieux-jour-marche-checkbox" type="checkbox" 
            value="<?= implode(';', $jour); ?>" id="qstprod-joursmarche-<?= $counter; ?>" 
            name="qstprod-joursmarche[]"
            <?= isset($currentForm['qstprod-joursmarche']) && in_array(implode(';', $jour), $currentForm['qstprod-joursmarche']) ? 'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-joursmarche-<?= $counter; ?>"><?= $jour[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="row">
          <div class="col">
            <button class="btn btn-success btn-sm" type="button" style="float: right;" 
              onmousedown="ajouterMarche('qstprod-adr-marche', 'qstprod-joursmarche');" 
              id="btn-signuplieuxdist-ajouter-marché">Ajouter ce marché</button>
          </div>
        </div>
      </div>

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

      <input type="text" name="cetcal_session_id" id="cetcal_session_id" value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signuplieuxdist-nav" id="qstprod-signuplieuxdist-nav" value="unset" hidden="hidden">
    </form>
  </div>
</div>
<script src="/src/scripts/js/cetcal/cetcal.min.signuplieuxdist.js"></script>