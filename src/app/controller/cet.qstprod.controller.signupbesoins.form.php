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
  $nav = $dataProcessor->processHttpFormData($_POST['qstprod-signupbesoins-nav']);
  if ($nav != 'valider' && $nav != 'retour') { /*Error de navigation TODO.*/ $nav = 'retour'; }
  $statut = $nav == 'valider' ? 'signuprecap.form' : 'signupconso.form';

  // POST form logic :
  /* *****************************************************************************/
  /* HTTP POST : var setup : *****************************************************/
  // POST form logic - dans l'ordre du formulaire HTML :
  $form_solidarites = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-besoins-solsprods']) ? $_POST['qstprod-besoins-solsprods'] : NULL);
  $form_solidarite_autre = $dataProcessor->processHttpFormData($_POST['qstprod-solprod-autre']);
  $form_participer = $dataProcessor->processHttpFormData($_POST['qstprod-question-reseaux-participation']);
  $form_besoins = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-besoins-actions']) ? $_POST['qstprod-besoins-actions'] : NULL);
  $form_besoin_autre = $dataProcessor->processHttpFormData($_POST['qstprod-action-autre']);
  $form_reflexions = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-besoins-groupesres']) ? $_POST['qstprod-besoins-groupesres'] : NULL);
  $form_reflexion_autre = $dataProcessor->processHttpFormData($_POST['qstprod-grouperes-autre']);

  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupbesoins.dto.php');
  $besoinsDto = new QstBesoinsDTO($form_solidarites, $form_solidarite_autre, $form_participer,
    $form_besoins, $form_besoin_autre, $form_reflexions, $form_reflexion_autre);
  $_SESSION['signupbesoins.form'] = serialize($besoinsDto);

  $_SESSION['signupbesoins.form.post'] = $_POST;
  $_SESSION['CONTEXTE_MODIF-signupbesoins'] = false;
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