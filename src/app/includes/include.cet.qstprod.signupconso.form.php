<?php 
$neant = '';
$currentForm = isset($_SESSION['signupconso.form.post']) ? $_SESSION['signupconso.form.post'] : array();
$cntxmdf = isset($_SESSION['CONTEXTE_MODIF-signupconso']) ? $_SESSION['CONTEXTE_MODIF-signupconso'] : false;
?>
<!-- singup lieux de distribution informations html form -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <form id="signupconso.form" class="form" method="post" 
      action="/src/app/controller/cet.qstprod.controller.signupconso.form.php">
      <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signup.entete.form.php'; ?>
      <!-- ------------------------- -->
      <!-- INPUTS formulaire START : ---
      <input class="form-control" id="qstprod-" name="qstprod-" type="text" placeholder="">
      ---- ------------------------- -->
      <br>
      <label class="cet-formgroup-container-label">
        <small class="form-text">
        Comment le consommateur va acheter / commander vos produits ?
        </small>
      </label>
      <div class="cet-formgroup-container">
        <label><small class="form-text">Comment le consommateur va acheter / commander vos produits ? (plusieurs options possibles)</small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->consomateurs_achats as $consoachat): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $consoachat); ?>" id="qstprod-consoachat-<?= $counter; ?>" 
            name="qstprod-consoachats[]"
            <?= isset($currentForm['qstprod-consoachats']) && in_array(implode(';', $consoachat), $currentForm['qstprod-consoachats']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-consoachat-<?= $counter; ?>"><?= $consoachat[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>
          <input class="form-control" id="qstprod-consoachatautre" name="qstprod-consoachatautre" 
            type="text" placeholder="Autre ? Merci de préciser" maxlength="128"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-consoachats'], $listes_arrays->consomateurs_achats); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-consoachatautre']) ? $currentForm['qstprod-consoachatautre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>

        <!-- Questions retirés le 17 mai 2021 : évols page des lieux de distribution.
        <br>
        <label><small class="form-text">Comment le consommateur va réceptionner vos produits ? (plusieurs options possibles)</small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->consomateurs_receptions as $reception): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $reception); ?>" id="qstprod-reception-<?= $counter; ?>" 
            name="qstprod-receptions[]"
            <?= isset($currentForm['qstprod-receptions']) && in_array(implode(';', $reception), $currentForm['qstprod-receptions']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-reception-<?= $counter; ?>">
            <?= $reception[1]; ?>
          </label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-receptionautre" name="qstprod-receptionautre" 
            type="text" placeholder="Autre ? Merci de préciser" maxlength="128"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-receptions'], $listes_arrays->consomateurs_receptions); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-receptionautre']) ? $currentForm['qstprod-receptionautre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si drive avec point de collecte, preciser l'adresse :</small></label>   
          <input class="form-control" id="qstprod-adr-drive" name="qstprod-adr-drive" type="text" 
            placeholder="Si drive avec point de collecte, preciser"
            value="<?= isset($currentForm['qstprod-adr-drive']) ? $currentForm['qstprod-adr-drive'] : $neant; ?>"
            maxlength="256">
        </div>
        <label><small class="form-text">Si drive, quels jours de collecte ?</small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->consomateurs_drive_jours as $jour): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $jour); ?>" id="qstprod-joursdrive-<?= $counter; ?>" 
            name="qstprod-joursdrive[]"
            <?= isset($currentForm['qstprod-joursdrive']) && in_array(implode(';', $jour), $currentForm['qstprod-joursdrive']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-joursdrive-<?= $counter; ?>"><?= $jour[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <br>
        -->
        
        <br>
        <label><small class="form-text">Comment les consommateurs peuvent vous payer ? Les Moyens de paiement (plusieurs options possibles)</small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->consomateurs_paiements as $paiment): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $paiment); ?>" id="qstprod-paiment-<?= $counter; ?>"
            name="qstprod-paiments[]"
            <?= isset($currentForm['qstprod-paiments']) && in_array(implode(';', $paiment), $currentForm['qstprod-paiments']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-paiment-<?= $counter; ?>"><?= $paiment[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-paimentautre" name="qstprod-paimentautre" type="text" 
            placeholder="Autre ? Merci de préciser" maxlength="128"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-paiments'], $listes_arrays->consomateurs_paiements); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-paimentautre']) ? $currentForm['qstprod-paimentautre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
      </div>

      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <button class="btn cet-navbar-btn" type="submit" onmousedown="$('#qstprod-signupconso-nav').val('retour');"
            id="btn-signupconso.form-retour"><?= CetQstprodConstLibelles::form_retour; ?></button>
          <button class="btn cet-navbar-btn" type="submit" onmousedown="$('#qstprod-signupconso-nav').val('valider');"
            id="btn-signupconso.form-valider"><?= CetQstprodConstLibelles::form_valider; ?></button>
        </div>
      </div>

      <input type="text" name="cetcal_session_id" id="cetcal_session_id" value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signupconso-nav-lindex" id="qstprod-signupconso-nav-lindex" value="unset" hidden="hidden">
      <input type="text" name="qstprod-signupconso-nav" id="qstprod-signupconso-nav" value="unset" hidden="hidden">
    </form>
  </div>
</div>

<!-- ------------------------------ -->
<!-- Specific js for this page only -->
<script src="/src/scripts/js/cetcal/cetcal.min.signuplieuxdist.js"></script>