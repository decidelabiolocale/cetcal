<?php
$neant = '';
$input_email_val = '';
$input_emailconf_val = '';
$currentForm = isset($_SESSION['signupgen.form.post']) ? $_SESSION['signupgen.form.post'] : array();
$cntxmdf = isset($_SESSION['CONTEXTE_MODIF-signupgen']) ? $_SESSION['CONTEXTE_MODIF-signupgen'] : false;
$cntxmdf_global = isset($_SESSION['CONTEXTE_MODIF-GLOBAL']) ? $_SESSION['CONTEXTE_MODIF-GLOBAL'] : false;
$email_used = (isset($_GET['err']) && strcmp($dataProcessor->processHttpFormData($_GET['err']), 'eused') === 0);
$used_email_value = isset($_GET['uemail']) ? $dataProcessor->processHttpFormData($_GET['uemail']) : "";
$pkprd = isset($_SESSION['CONTEXTE_MODIF-PKPRD']) ? $_SESSION['CONTEXTE_MODIF-PKPRD'] : "";
?>
<!-- singup general informations html form -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <form id="signupgen.form" class="form" method="post" action="/src/app/controller/cet.qstprod.controller.signupgen.form.php">
      <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signup.entete.form.php'; ?>
      <!-- ------------------------- -->
      <!-- INPUTS formulaire START : ---
      <input class="form-control" id="qstprod-" name="qstprod-" type="text" placeholder="">
      ---- ------------------------- -->
      <br>
      <label class="cet-formgroup-container-label"><small class="form-text">Informations générales :</small></label>
      <div class="cet-formgroup-container">
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Nom de famille :</small></label>
          <input class="form-control" id="qstprod-nom" name="qstprod-nom" type="text" placeholder="Nom de famille" maxlength="30"
            value="<?= isset($currentForm['qstprod-nom']) ? $currentForm['qstprod-nom'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Prénom :</small></label>
          <input class="form-control" id="qstprod-prenom" name="qstprod-prenom" type="text" placeholder="Prénom"
            value="<?= isset($currentForm['qstprod-prenom']) ? $currentForm['qstprod-prenom'] : $neant; ?>"
            maxlength="30">
        </div>
        <div class="form-group mb-3">
          <?php if ($email_used): ?>
            <?php $input_email_val = $used_email_value; ?>
            <?php $input_emailconf_val = $used_email_value; ?>
            <label class="cet-input-label">
              <small class="cet-qstprod-label-text" style="color: red !important;">
                L'adresse e-mail renseignée est déjà associée à un compte décidelabiolocale.org existant, veuillez en saisir une autre :
              </small>
            </label>
          <?php elseif ($email_used === false): ?>
            <?php $input_email_val = isset($currentForm['qstprod-email']) ? $currentForm['qstprod-email'] : $neant; ?>
            <?php $input_emailconf_val = isset($currentForm['qstprod-email-conf']) ? $currentForm['qstprod-email-conf'] : $neant; ?>
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Adresse e-mail :</small></label>
          <?php endif; ?>
          <input class="form-control" id="qstprod-email" name="qstprod-email" type="text" placeholder="Adresse e-mail"
            onblur="checkValidEmail(60, 'qstprod-email');"
            value="<?= $input_email_val; ?>"
            maxlength="60">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Confirmation adresse e-mail :</small></label>
          <input class="form-control" id="qstprod-email-conf" name="qstprod-email-conf" type="text" 
            placeholder="Confirmation adresse e-mail" 
            onblur="checkValidEmailConfirmation(60, 'qstprod-email', this.id);"
            value="<?= $input_emailconf_val; ?>"
            maxlength="60">
        </div>
        <?php if ($cntxmdf === false && $cntxmdf_global === false): ?> 
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Mot de passe de connexion à l'annuaire (8 caractères minimum) :</small></label>
            <input class="form-control is-invalid" id="qstprod-mdp" name="qstprod-mdp" type="password" 
              placeholder="Mot de passe de connexion à l'annuaire"
              onblur="checkFormInputMin(30, 8, this.id);"
              maxlength="30">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Confirmer votre mot de passe :</small></label>
            <input class="form-control is-invalid" id="qstprod-mdpconf" name="qstprod-mdpconf" 
              type="password" placeholder="Confirmer votre mot de passe"
              onblur="checkMotsDePasse(30, 8, 'qstprod-mdp', this.id);"
              maxlength="30">
          </div>
        <?php endif; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">N° de téléphone fixe :</small></label>
          <input class="form-control" id="qstprod-numbtel-fix" name="qstprod-numbtel-fix" type="text" 
            maxlength="10" minlength="10" placeholder="N° de téléphone fixe."
            value="<?= isset($currentForm['qstprod-numbtel-fix']) ? $currentForm['qstprod-numbtel-fix'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">N° de téléphone mobile :</small></label>
          <input class="form-control" id="qstprod-numbtel-port" name="qstprod-numbtel-port" type="text" 
            maxlength="10" minlength="10" placeholder="N° de téléphone mobile."
            value="<?= isset($currentForm['qstprod-numbtel-port']) ? $currentForm['qstprod-numbtel-port'] : $neant; ?>">
        </div>
      </div>
      
      <label class="cet-formgroup-container-label" for="qstprod-nomferme"><small class="form-text">Veuillez renseigner les informations liées à la certification AB :</small></label>
      <div class="cet-formgroup-container">
        <div class="input-group mb-3">
          <div class="form-check form-check-inline">
            <input class="form-check-input qstprod-bio-certifs-ab" type="radio" value="1" 
              id="qstprod-bio-certifs-cab" name="qstprod-bio-certifs-ab"
              <?= isset($currentForm['qstprod-bio-certifs-ab']) && 
                strcmp($currentForm['qstprod-bio-certifs-ab'], '1') === 0 ? 'checked="checked"' : $neant; ?>> 
            <label class="form-check-label cet-qstprod-label-text" 
              for="qstprod-bio-certifs-cab"><img src="/res/content/icons/logos-verts-europe-ab.png" height="30" alt="">&#160;&#160;Je déclare être <b>certifié Agriculture-Biologique</b>.</label>
            <br>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input qstprod-bio-certifs-ab" type="radio" value="2" 
              id="qstprod-bio-certifs-conversion" name="qstprod-bio-certifs-ab"
              <?= isset($currentForm['qstprod-bio-certifs-ab']) && 
                strcmp($currentForm['qstprod-bio-certifs-ab'], '2') === 0 ? 'checked="checked"' : $neant; ?>> 
            <label class="form-check-label cet-qstprod-label-text" 
              for="qstprod-bio-certifs-conversion">Je suis <b>en cours de certification AB</b> (années C1 ou C2). Pas encore certifié AB.</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input qstprod-bio-certifs-ab" type="radio" value="3" 
              id="qstprod-bio-certifs-ytendant" name="qstprod-bio-certifs-ab"
              <?= isset($currentForm['qstprod-bio-certifs-ab']) && 
                strcmp($currentForm['qstprod-bio-certifs-ab'], '3') === 0 ? 'checked="checked"' : $neant; ?>>
            <label class="form-check-label cet-qstprod-label-text" 
              for="qstprod-bio-certifs-ytendant">Je pratique une <b>agriculture éthique sans produits phyto-sanitaires chimiques</b>, cependant je ne possède pas de certification AB.</label>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text"><img src="/res/content/icons/logos-verts-europe-ab.png" height="30" alt="">&#160;&#160;Si vous êtes certifiés AB, veuillez nous indiquer votre organisme de certificationation :</small></label>
          <select class="form-control" id="qstprod-bio-certifs-ab-org" name="qstprod-bio-certifs-ab-org">
            <option value="0" selected="selected">-- Aucun organisme de certification AB sélectionné --</option>
            <?php foreach ($listes_arrays->orgs_certif_bio as $org): ?>
              <option value="<?= $org; ?>" <?= isset($currentForm['qstprod-bio-certifs-ab-org']) && 
                strcmp($currentForm['qstprod-bio-certifs-ab-org'], $org) === 0 ? 'selected="selected"' : $neant; ?>><?= $org; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <label class="cet-formgroup-container-label" for="qstprod-nomferme"><small class="form-text">Renseignez vos informations d'adresse d'exploitation :</small></label>
      <div class="cet-formgroup-container">
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Nom de la ferme :</small></label>
          <input class="form-control" id="qstprod-nomferme" name="qstprod-nomferme" type="text" 
            placeholder="Nom de la ferme" onblur="checkFormInput(60, this.id);"
            value="<?= isset($currentForm['qstprod-nomferme']) ? $currentForm['qstprod-nomferme'] : $neant; ?>"
            maxlength="60">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">N° Siret de la ferme :</small></label>
          <input class="form-control" id="qstprod-siret" name="qstprod-siret" type="text" maxlength="14" 
            minlength="14" placeholder="Siret" onblur="checkSiret(this.id);"
            value="<?= isset($currentForm['qstprod-siret']) ? $currentForm['qstprod-siret'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Numéro sur voirie de la ferme :</small></label>
          <input class="form-control" id="qstprod-numvoie" name="qstprod-numvoie" type="text" 
            placeholder="Numéro sur voirie"
            value="<?= isset($currentForm['qstprod-numvoie']) ? $currentForm['qstprod-numvoie'] : $neant; ?>"
            maxlength="12">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Nom de la rue, chemin, avenue... :</small></label>
          <input class="form-control" id="qstprod-rue" name="qstprod-rue" type="text" 
            placeholder="Nom de la rue, chemin, avenue..."
            value="<?= isset($currentForm['qstprod-rue']) ? $currentForm['qstprod-rue'] : $neant; ?>"
            maxlength="128">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Lieu dit :</small></label>
          <input class="form-control" id="qstprod-lieudit" name="qstprod-lieudit" type="text" placeholder="Lieu dit"
            value="<?= isset($currentForm['qstprod-lieudit']) ? $currentForm['qstprod-lieudit'] : $neant; ?>"
            maxlength="60">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Commune de la ferme :</small></label>
          <input class="form-control is-invalid" id="qstprod-commune" name="qstprod-commune" type="text" placeholder="Commune"
            onblur="checkFormInput(45, this.id);"
            value="<?= isset($currentForm['qstprod-commune']) ? $currentForm['qstprod-commune'] : $neant; ?>"
            maxlength="45">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Code postal :</small></label>
          <input class="form-control is-invalid" id="qstprod-cp" name="qstprod-cp" type="text" maxlength="5" placeholder="Code postal"
            onblur="checkFormInputInteger(9, 4, this.id);"
            value="<?= isset($currentForm['qstprod-cp']) ? $currentForm['qstprod-cp'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">  
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Complément d'adresse :</small></label>
          <input class="form-control" id="qstprod-cmpladrs" name="qstprod-cmpladrs" type="text" 
            placeholder="Complément d'adresse"
            value="<?= isset($currentForm['qstprod-cmpladrs']) ? $currentForm['qstprod-cmpladrs'] : $neant; ?>"
            maxlength="60">
        </div>
      </div>

      <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signupinfosweb.area.form.php'; ?>

      <label class="cet-formgroup-container-label"><small class="form-text">Activité de production :</small></label>
      <div class="cet-formgroup-container">
        <label><small class="form-text">Concernant votre activité de production ? (plusieurs options possibles)</small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->activites as $activite): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $activite); ?>" id="qstprod-besoins-activite-<?= $counter; ?>" 
            name="qstprod-besoins-activites[]"
            <?= isset($currentForm['qstprod-besoins-activites']) && in_array(implode(';', $activite), $currentForm['qstprod-besoins-activites']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-besoins-activite-<?= $counter; ?>"><?= $activite[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-activite-production-autre" name="qstprod-activite-production-autre" type="text" maxlength="45"
            placeholder="Quelle autre activité de production ?"            
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-besoins-activites'], $listes_arrays->activites); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-activite-production-autre']) ? $currentForm['qstprod-activite-production-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Superficie cultivée <b>plein champ</b> en <b>hectares</b> :</small></label>
          <input class="form-control" id="qstprod-surfacepc" name="qstprod-surfacepc" type="number" min="0"
            step="0.10" placeholder="Superficie cultivée plein champ en hectares"
            value="<?= isset($currentForm['qstprod-surfacepc']) ? $currentForm['qstprod-surfacepc'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Superficie de culture <b>serre</b> en <b>ares</b> :</small></label>
          <input class="form-control" id="qstprod-supserre" name="qstprod-supserre" type="number" min="0"
            step="0.10" placeholder="Superficie de culture serre en ares"
            value="<?= isset($currentForm['qstprod-supserre']) ? $currentForm['qstprod-supserre'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si bétail, le nombres de têtes :</small></label>
          <input class="form-control" id="qstprod-nbrtetes" name="qstprod-nbrtetes" type="number" min="0"
            step="1" placeholder="Nombres de têtes"
            value="<?= isset($currentForm['qstprod-nbrtetes']) ? $currentForm['qstprod-nbrtetes'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Pour bière, lait ou vins, hectolitres / an :</small></label>
          <input class="form-control" id="qstprod-hectolitresparan" name="qstprod-hectolitresparan" type="number" min="0"
            step="0.1" placeholder="Hectolitres / an"
            value="<?= isset($currentForm['qstprod-hectolitresparan']) ? $currentForm['qstprod-hectolitresparan'] : $neant; ?>">
        </div>
      </div>

      <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signupsondage.area.form.php'; ?>
      <!-- ------------------------ -->
      <!-- INPUTS formulaire STOP : -->      
      <!-- ------------------------ -->

      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <button class="btn cet-navbar-btn" type="submit" onmousedown="$('#qstprod-signupgen-nav').val('retour');"
            id="btn-signupgen-form-retour">Annuler et retour à l'accueil</button>
          <button class="btn cet-navbar-btn" type="submit" id="btn-signupgen-form-valider" onmousedown="$('#qstprod-signupgen-nav').val('valider');"><?= CetQstprodConstLibelles::form_valider; ?></button>
        </div>
      </div>

      <input type="text" name="cetcal_session_id" id="cetcal_session_id" value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signupgen-nav" id="qstprod-signupgen-nav" 
        value="unset" hidden="hidden">
      <input type="text" name="qstprod-signupgen-cntx" id="qstprod-signupgen-cntx" 
        value="<?= $cntxmdf ? 'mdif' : 'insc'; ?>" hidden="hidden">
      <input type="text" name="qstprod-signupgen-pkprd" id="qstprod-signupgen-pkprd" 
        value="<?= $pkprd; ?>" hidden="hidden">
    </form>
  </div>
</div>
<script src="/src/scripts/js/cetcal/cetcal.min.signupgen.js"></script>