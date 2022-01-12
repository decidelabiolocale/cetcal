<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PATH_MODEL = $DOC_ROOT.'/src/app/model/';
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($PATH_MODEL.'cet.qstprod.producteurs.model.php');
$producteur_model = new QSTPRODProducteurModel();
$dataProcessor = new HTTPDataProcessor();

$action = $dataProcessor->processHttpFormData($_GET['action']);
$fk = $dataProcessor->processHttpFormData($_GET['pkprd']);
$sitkn = $dataProcessor->processHttpFormData($_GET['sitkn']);
$usridf = $dataProcessor->processHttpFormData($_GET['usridf']);
$latlng = $dataProcessor->processHttpFormData($_GET['latlng']);

if (empty($action))
{
  echo json_encode(['etat' => 'false', 'msg' => 'Une erreur est survenue, nous ne trouvons pas vos données de géolocalisation. Veuillez prendre contact avec notre équipe.']);
}
else if (strcmp($action, 'get') === 0)
{
  error_log("[lookup GET latlng ferme producteur] pk producteur=".$fk);
  require_once($PATH_MODEL.'cet.qstprod.cartographie.model.php');
  $model = new CETCALCartographieModel();
  $data = $model->getLatLng($fk);
  $json = json_encode(['etat' => 'true', 'msg' => 'Vos données de géolocalisation :', 'lng' => $data['cetcal_prd_lat'], 'lat' => $data['cetcal_prd_lng']]);
  error_log("[lookup latlng ferme producteur] retourne JSON : ".$json);
  echo $json;
}
else if (strcmp($action, 'update') === 0)
{
  $latlng_array = null;
  try 
  {
    $latlng = trim($latlng);
    $latlng = str_replace(" ", "", $latlng);
    $latlng = str_replace(",", ";", $latlng);
    $latlng_array = explode(';', $latlng);
  } 
  catch (Exception $e) 
  {
    error_log("[lookup UPDATE Error] pk producteur=".$fk. " err=".$e->getMessage());
    echo json_encode(['etat' => 'false', 'msg' => 'Une erreur est survenue lors de la mise à jour de vos données de carthographie.']); 
  }

  error_log("[UPDATE latlng ferme producteur] pk producteur=".$fk);
  require_once($PATH_MODEL.'cet.qstprod.cartographie.model.php');
  $model = new CETCALCartographieModel();
  $model->updateManuelLatLng($fk, $latlng_array);
  $json = json_encode(['etat' => 'true', 'msg' => 'Vos données de géolocalisation :', 'lat' => $latlng_array[1], 'lng' => $latlng_array[0]]);
  error_log("[lookup latlng ferme producteur] retourne JSON : ".$json);
  echo $json;
}
else if (strcmp($action, 'geoloc-auto') === 0)
{
  error_log("[UPDATE Cartographie producteur] gestion auto geoloc sur base adresse postale pour pk producteur=".$fk);
  require_once($PATH_MODEL.'cet.qstprod.cartographie.model.php');
  $model = new CETCALCartographieModel();
  $model->deleteForceProducteur($fk);
  $json = json_encode(['etat' => 'true', 'msg' => 'La géolocalisation de votre ferme dépend maintenant de votre adresse postale.', 'lat' => '', 'lng' => '']);
  echo $json;
}

return;
