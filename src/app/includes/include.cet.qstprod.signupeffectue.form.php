<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$insrp_validee_email = (isset($_GET['ev']) && !empty($_GET['ev'])) ? 
  $dataProcessor->processHttpFormData($_GET['ev']) : "[email non renseigné]";
$idcetwww = (isset($_GET['idfcet']) && !empty($_GET['idfcet'])) ? 
  $dataProcessor->processHttpFormData($_GET['idfcet']) : "[erreure sur identifiant, veuillez nous contacter]";
?>
<!-- page de validation envoyé et traité avec succés -->
<div class="cet-module row justify-content-lg-center" id="cet-qstprod_referece" style="margin-bottom: 60px;">
  <div class="col-lg-6">
    <div class="alert alert-success" role="alert">
      <h5 class="alert-heading">Bienvenu.e Producteur.e.s !</h5>
      <h5 class="alert-heading">Nous avons traité votre inscription avec succès. Vous êtes maintenant référencé dans l'annuaire. Merci.</h5>
      <!-- Zone retiré le 17 mai 2021 : identifiant reste interne.
      <p><b>Veuillez noter votre identifiant cetcal.site :</b></p>
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <?php foreach (str_split($idcetwww) as $caractere): ?>
            <span class="badge badge-success cet-idcetwww-char">
              <?= $caractere; ?>
            </span>
            <span> </span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      -->
      <br>
      <p>Un email de confirmation d'inscription vous a été envoyé à l'adresse <b><?= $insrp_validee_email; ?></b>.</p>
      <p>Vous pourrez dès à présent administrer votre espace produteur.e cliquant sur <b><i>"Se connecter"</i></b> depuis notre page d'accueil. Pour ajouter des images ou un logo à votre profil, ou bien affiner votre géolocalisation, nous vous invitons à vous connecter à votre espace prodiucteur.e.</p>
      <p>Vous pouvez dès maintenant <a href="/">retourner à l'accueil.</a></p>
    </div>
  </div>
</div>