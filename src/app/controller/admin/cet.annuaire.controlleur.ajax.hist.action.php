<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.hist.action.model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.actions.admin.codes.php');
$dataProcessor = new HTTPDataProcessor();

$sitkn = $dataProcessor->processHttpFormData($_GET['sitkn']);

$pk = $dataProcessor->processHttpFormData($_POST['admpk']);
$login = $dataProcessor->processHttpFormData($_POST['admlog']);
$action_code = $dataProcessor->processHttpFormData($_POST['admactcde']);
$type_element = $dataProcessor->processHttpFormData($_POST['type']);
$denomination_element = $dataProcessor->processHttpFormData($_POST['denom']);
$pk_element = $dataProcessor->processHttpFormData($_POST['pk']);
$commentaire = $dataProcessor->processHttpFormData($_POST['cmt']);

try 
{
  $authModel = new CETCALAdminModel();
  $auth = $authModel->authTempSessionId($sitkn);

  if ($auth === 1)
  {
    $adm_act_libfonc = CetAnnuaireConstCodeActionAdmin::CODE_FONC[$action_code];
    $histoAction = new CETCALAdminHistoriqueActionModel();
    $histoAction->insert($pk, $login, $action_code, $adm_act_libfonc, $pk_element, $type_element, $denomination_element, $commentaire);
  }
  else
  {
    throw new Exception('error log action administrateur pour loggin adm='.$login, 403);
  }
}
catch (Exception $e) 
{
  error_log("[ADMIN CETCAL] erreur : ".$e->getMessage." | acces refuse HTTP 403.");
  echo json_encode(array(
      'error' => array(
          'msg' => $e->getMessage(),
          'code' => $e->getCode(),
      ),
  ));
}