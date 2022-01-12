<?php
$cetcal_session_id = NULL;

try
{
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $cetcal_session_id = $dataProcessor->processHttpFormData($_POST['cetcal_session_id']);
  session_id($cetcal_session_id);
  session_start();

  // Prepare navigation :
  $nav = $dataProcessor->processHttpFormData($_POST['qstprod-signuplieuxdist-nav']);
  if ($nav != 'valider' && $nav != 'retour') /*Error de navigation TODO.*/ $nav = 'retour'; 
  $statut = $nav == 'valider' ? 'signupprods.form' : 'signupgen.form';

  // POST form logic :
  /* *****************************************************************************/
  /* HTTP POST : var setup : *****************************************************/
  // POST form logic - dans l'ordre du formulaire HTML :
  $form_json_data = $dataProcessor->processHttpFormData($_POST['qstprod-signuplieuxdist-json']);
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
  $dtoLieuDist = new QstLieuxDistributionDTO(urldecode($form_json_data));
  $_SESSION['signuplieuxdist.form'] = serialize($dtoLieuDist);

  $_SESSION['signuplieuxdist.form.post'] = $_POST;
  if ($nav == 'valider') $_SESSION['CONTEXTE_MODIF-signuplieuxdist'] = false;
  session_write_close();
  /* *****************************************************************************/

  // Apply navigation :
  header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id);
  exit();
}
catch (Exception $e) 
{
  session_write_close();
  error_log($e->getMessage());
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage().'&sitkn='.$cetcal_session_id);
  exit();
}