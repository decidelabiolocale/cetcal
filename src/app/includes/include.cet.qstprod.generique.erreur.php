<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$err = isset($_GET['err']) ? $dataProcessor->processHttpFormData($_GET['err']) : "Erreure technique rencontrée.";
?>
<!-- page de validation envoyé et traité avec succés -->
<div class="cet-module row justify-content-lg-center" id="cet-qstprod_err-genrique" style="margin-bottom: 60px;">
  <div class="col-lg-9">
    <div class="alert alert-danger" role="alert">
      <h5 class="alert-heading">Erreur rencontrée</h5>
      <h6 class="alert-heading">Nous nous excusons pour toute gêne occasionnée.</h6>
      <p><b><?= $err; ?></b></p>
      <p>Vous pouvez dès maintenant <a href="/">retourner à l'acceuil.</a></p>
      <p></p>
    </div>
  </div>
</div>