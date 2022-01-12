<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.marches.castillonnais.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.lieuxdist.model.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.types.php');
$dataProcessor = new HTTPDataProcessor();
$type = $dataProcessor->processHttpFormData($_POST['action']);
$cible = $dataProcessor->processHttpFormData($_POST['cible']);

error_log($type. '/ ' .$cible);

if (!isset($type) || !isset($cible) || empty($type) || empty($cible))
{
  echo json_encode('{}');
} 
else 
{
  if (strcmp($cible, "entite") === 0)
  {
    $typesEntite = '';
    try 
    {
      $typesEntite = CetAnnuaireConstTypes::TRANSCO_TYPE_ENTITE[$type];
      require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/model/cet.qstprod.lieuxdist.model.php');
      $model = new QSTPRODLieuModel();
      $data = $model->getDenominatonsByTypes($typesEntite);
      echo json_encode($data);
    }
    catch (Exception $e)
    {
      echo json_encode(array(
        'error' => array(
            'msg' => 'Imposible de lire les entites pour le type:'.$type,
            'code' => 204
        ),
      ));
    }
  }
  else if (strcmp($cible, "sous_type") === 0)
  {
    $model = new QSTPRODLieuModel();
    $data = $model->getSousTypesSiNonNULL(strtolower(trim($type)));
    echo json_encode($data);
  }
}