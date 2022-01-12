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
  $form_points_vente = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-pdv']) ? $_POST['qstprod-pdv'] : NULL);
  $form_point_vente_autre = $dataProcessor->processHttpFormData($_POST['qstprod-pdvautre']);
  $form_marche_adr = $dataProcessor->processHttpFormData($_POST['qstprod-adr-marche']);
  $form_marche_jours = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-joursmarche']) ? $_POST['qstprod-joursmarche'] : NULL);
  $form_marche_saisies = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-joursmarche-sasies']) ? $_POST['qstprod-joursmarche-sasies'] : NULL);

  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
  $dtoLieuDist = new QstLieuxDistributionDTO($form_points_vente, $form_point_vente_autre,
    $form_marche_adr, $form_marche_jours, $form_marche_saisies);
  $_SESSION['signuplieuxdist.form'] = serialize($dtoLieuDist);

  $_SESSION['signuplieuxdist.form.post'] = $_POST;
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