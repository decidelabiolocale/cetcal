<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($DOC_ROOT.'/src/app/controller/media/cet.qstprod.controller.media.php');
$dataProcessor = new HTTPDataProcessor();
$ctrl = new MediaController();

$pk = $dataProcessor->processHttpFormData($_GET['pk']);
$tbl = $dataProcessor->processHttpFormData($_GET['tbl']);

if (strcmp($tbl, 'producteur') === 0)
{
  $data = $ctrl->selectMediasProducteur($pk);
  echo json_encode($data);
  exit();
}
else if (strcmp($tbl, 'entite') === 0)
{
  $data = $ctrl->selectMediasEntite($pk);
  echo json_encode($data);
  exit();
}
else
{

}