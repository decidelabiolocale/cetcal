<?php
$cetcal_session_id = "";
try 
{
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $cetcal_session_id = $dataProcessor->processHttpFormData($_POST['cetcal_session_id']);
  session_id($cetcal_session_id);
  session_start();
  
  // Prepare navigation :
  $nav = $dataProcessor->processHttpFormData($_POST['qstprod-signupconso-nav']);
  if ($nav != 'valider' && $nav != 'retour') { /*Error de navigation TODO.*/ $nav = 'retour'; }
  $statut = $nav == 'valider' ? 'signupbesoins.form' : 'signupprods.form';

  // POST form logic :
  /* *****************************************************************************/
  /* HTTP POST : var setup : *****************************************************/
  // POST form logic - dans l'ordre du formulaire HTML :
  $form_achats = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-consoachats']) ? $_POST['qstprod-consoachats'] : NULL);
  $form_achatAutre = $dataProcessor->processHttpFormData($_POST['qstprod-consoachatautre']);
  $form_receptionsMoyens = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-receptions']) ? $_POST['qstprod-receptions'] : NULL);
  $form_receptionsMoyenAutre = $dataProcessor->processHttpFormData($_POST['qstprod-receptionautre']);
  $form_paimentsMoyens = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-paiments']) ? $_POST['qstprod-paiments'] : NULL);
  $form_paimentsMoyenAutre = $dataProcessor->processHttpFormData($_POST['qstprod-paimentautre']);
  $form_driveadr = $dataProcessor->processHttpFormData($_POST['qstprod-adr-drive']);
  $form_drivejour = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-joursdrive']) ? $_POST['qstprod-joursdrive'] : NULL);

  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupconso.dto.php');
  $consoDto = new QstConsomateursDTO($form_achats, $form_achatAutre,
      $form_receptionsMoyens, $form_receptionsMoyenAutre, $form_paimentsMoyens, 
      $form_paimentsMoyenAutre, $form_driveadr, $form_drivejour);
  $_SESSION['signupconso.form'] = serialize($consoDto);

  $_SESSION['signupconso.form.post'] = $_POST;
  $_SESSION['CONTEXTE_MODIF-signupconso'] = false;
  session_write_close();
  /* *****************************************************************************/

  // Apply navigation :
  header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id);
  exit();
}
catch (Exception $e) 
{
  session_write_close();
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage().'&sitkn='.$cetcal_session_id);
  exit();
}