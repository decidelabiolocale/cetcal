<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/media/cet.qstprod.controller.media.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$ctrl = new MediaController();

$idm = $dataProcessor->processHttpFormData($_GET['idm']);
$pkprd = isset($_GET['pkprd']) ? $dataProcessor->processHttpFormData($_GET['pkprd']) : false;
$pkent = isset($_GET['pkent']) ? $dataProcessor->processHttpFormData($_GET['pkent']) : false;
$urlr = $dataProcessor->processHttpFormData($_GET['urlr']);

if ($pkprd !== false)
{
  $ctrl->deleteMediaProducteur($idm, $pkprd);
  if (!unlink($_SERVER['DOCUMENT_ROOT'].$urlr)) 
  {
    error_log("[CONTROL DELETE Media] erreur : impossible de supprimer physiquement le media=".$urlr);
    echo json_encode(['etat' => 'false', 'msg' => 'Impossible de supprimer le fichier.']);
    exit();
  }
  else 
  {
    error_log("[CONTROL DELETE Media] suppression effective pour media=".$urlr);
    echo json_encode(['etat' => 'true', 'msg' => 'Suppression du fichier effectué.']);
    exit();
  }
}
else if ($pkent !== false)
{
  $ctrl->deleteMediaEntite($idm, $pkent);
  if (!unlink($_SERVER['DOCUMENT_ROOT'].$urlr)) 
  {
    error_log("[CONTROL DELETE Media] erreur : impossible de supprimer physiquement le media=".$urlr);
    echo json_encode(['etat' => 'false', 'msg' => 'Impossible de supprimer le fichier.']);
    exit();
  }
  else 
  {
    error_log("[CONTROL DELETE Media] suppression effective pour media=".$urlr);
    echo json_encode(['etat' => 'true', 'msg' => 'Suppression du fichier effectué.']);
    exit();
  }
}
else
{
  error_log("[CONTROL DELETE Media] erreur : impossible de definir l element a supprimer.");
  echo json_encode(['etat' => 'false', 'msg' => 'Erreur sur aiguillage de votre demande.']);
  exit();
}