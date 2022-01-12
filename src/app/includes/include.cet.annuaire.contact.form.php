<?php
$neant = "";
$etat = isset($_GET['etat']) ? $dataProcessor->processHttpFormData($_GET['etat']) : false;
$demande = isset($_GET['demande']) ? $dataProcessor->processHttpFormData($_GET['demande']) : $neant;
$email = isset($_GET['em']) ? $dataProcessor->processHttpFormData($_GET['em']) : $neant;
$ntelport = isset($_GET['ntp']) ? $dataProcessor->processHttpFormData($_GET['ntp']) : $neant;
$texte = isset($_GET['txt']) ? $dataProcessor->processHttpFormData($_GET['txt']) : $neant;
$heading = strcmp($demande, 'jesuisproducteur') === 0 ? "Je suis producteur.e référencé et je n'arrive pas à me connecter sur cetcal.site" : "Formulaire de contact";
$heading = strcmp($demande, 'jeconstateuneerreurdecarto') === 0 ? "Je constate une information en défaut sur la carte des Producteur.e.s et lieux de distribution" : "Formulaire de contact";
?>

<?php if ($etat === false): ?>
<div class="cet-module row justify-content-lg-center">
  <div class="col-lg-6">
    <form id="contact.form" class="form" method="post" action="/src/app/controller/cet.annuaire.controller.contact.form.php">
      <label class="cet-formgroup-container-label"><small class="form-text">Veuillez renseigner le formulaire de contact :</small></label>
      <div class="cet-formgroup-container">
        <h4 class="alert-heading"><?= $heading; ?></h4>
        <p></p>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">N° de téléphone fixe ou mobil :</small></label>
          <input class="form-control is-invalid" id="annuaire-contact-ntel" name="annuaire-contact-ntel" 
            type="text" maxlength="10" minlength="10" placeholder="N° de téléphone"
            onblur="checkFormInput(10, 'annuaire-contact-ntel');"
            value="<?= isset($ntelport) && !empty($ntelport) ? $ntelport : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Votre adresse email :</small></label>
          <input class="form-control is-invalid" id="annuaire-contact-email" 
            name="annuaire-contact-email" onblur="checkValidEmail(60, 'annuaire-contact-email');"
            type="text" maxlength="60" placeholder="Adresse email"
            value="<?= isset($email) && !empty($email) ? $email : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Veuillez nous expliquer votre problématique.</small></label> 
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Afin de faciliter la prise de contact, veuillez préciser un horaire préféré pour être appelé.</small></label>   
          <textarea class="form-control is-invalid" id="annuaire-contact-problematique" 
            name="annuaire-contact-problematique" maxlength="1024"
            placeholder="<?= strcmp($demande, 'jeconstateuneerreurdecarto') === 0 ? "Veuillez détailler le défaut d'information constaté (Ex: le nom de la ferme en question ainsi que l'information faisant défaut). Merci pour toute aide et participation." : (strcmp($demande, 'jesuisproducteur') === 0 ? "Afin de pouvoir traiter votre demande, veuillez nous préciser un horaire d'appel et détailler votre demande..." : "Afin de pouvoir traiter votre demande, veuillez nous préciser un maximum d'informations."); ?>"
            onblur="checkFormInput(1024, 'annuaire-contact-problematique');"
            value=""></textarea>
        </div>
        <input type="text" name="annuaire-contact-obj" id="annuaire-contact-obj" 
          value="<?= isset($demande) && !empty($demande) ? $demande : $neant; ?>" hidden="hidden">
      </div>

      <div class="input-group mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="annuaire-contact-antispan"
              name="annuaire-contact-antispan" value="ok">
            <label><span style="color: red;">Je déclare que les informations renseignées sont exactes et que la demande est clairement formulée.</span></label>
        </div>
      </div>

      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <a class="btn cet-navbar-btn" href="./"
            id="btn-contact-form-retour">Annuler et retour à l'accueil</a>
          <button class="btn cet-navbar-btn" type="submit" id="btn-contact-form-valider"><i class="fas fa-sign-in-alt"></i>&#160;&#160;&#160;Envoyer ma demande</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php elseif ($etat !== false): ?>
  <?php if (strcmp($etat, 'trt') === 0): ?>
    <div class="cet-module row justify-content-lg-center" style="margin-bottom: 20px;">
      <div class="col-lg-6">
        <div class="cet-formgroup-container">
          <h4 class="alert-heading">Demande traitée avec succès.</h4>
          <p>Un email vient d'être envoyé à l'adresse <b><?= $email; ?></b></p>
          <p>
            Les détails de votre demande :<br>Votre numéro de téléphone : <b><?= $ntelport; ?></b><br>
            Votre demande :<br><?= $texte; ?>
          </p>
          <p>Votre demande est parvenue à l'équipe decidelabiolocale.org. Elle sera traité dans les plus brefs délais.</p>
          <p><a href="./">Retourner à l'accueil</a></p>
        </div>
      </div>
    </div>
  <?php endif; ?>  
<?php endif; ?>
<script type="text/javascript" src="/src/scripts/js/cetcal/cetcal.min.contact.form.js"></script>