<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($DOC_ROOT.'/src/app/model/cet.qstprod.producteurs.model.php');
require_once($DOC_ROOT.'/src/app/model/cet.annuaire.produits.model.php');
require_once($DOC_ROOT.'/src/app/utils/cet.annuaire.geocoordinate.helper.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.certification.bioab.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.communes.model.php');

$certif_controller = new CertificationBioABProducteurController();
$model_prd = new QSTPRODProducteurModel();
$model_produits = new AnnuaireProduitsModel();
$model_communes = new CETCALCommunesModel();
$dataProcessor = new HTTPDataProcessor();
$geo_helper = new GeoCoordinateHelper();

$json = json_decode($_GET['json']);
$commune_cp_hp = $json->commune_hp;
$rayon = $json->rayon_hp;
//$categories = $json->categories;
$critere = $json->criteresplus_hp;

$result = [];
$result_inscrits = $model_prd->fetchAllFrontEndDTOArray();
$result_preinscrits = $model_prd->fetchAllFrontEndDTOArrayPreInscrits();
$producteurs = array_merge($result_preinscrits, $result_inscrits);

/** ************************************************************************
 * Filtre commune et rayon.
 *
if (strlen($commune_cp) > 0 && isset($rayon) && $rayon > -1)
{
  error_log("rayon_hp:".$rayon_hp);
  error_log("commune_cp_hp:".$commune_cp_hp);
  $latlng = explode(";", $model_communes->selectLatLngByLibelle($commune_cp));
  error_log($latlng[0]."/".$latlng[1]);
  
  for ($i = 0; $i < count($producteurs); ++$i) 
  {
    $distance_km = $geo_helper->haversineGreatCircleDistance(
      $latlng[1], $latlng[0], $producteurs[$i]->getLat(), $producteurs[$i]->getLng()) / 1000;
    error_log("distance km:".($distance_km));
    if ($distance_km <= $rayon) array_push($result, $producteurs[$i]);
  }

  $producteurs = $result;
}*/

echo json_encode($result);