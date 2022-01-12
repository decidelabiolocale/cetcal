<?php
require_once('cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class CertificationBioABProducteurController extends AnnuaireController
{

  function __construct() { }

  public function certifierProducteur($pk, $url, $num_certif)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.biodata.model.php');
    $model = new BioDataModel();
    return $model->certifierProducteur($pk, $url, $num_certif);
  }

  public function decertifierProducteur($pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.biodata.model.php');
    $model = new BioDataModel();
    return $model->decertifierProducteur($pk);
  }

  public function getCertificationProducteur($pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.biodata.model.php');
    $model = new BioDataModel();
    $data = $model->getCertificationProducteur($pk);
    return isset($data) && !empty($data) && $data !== NULL ? $data : false;
  }  

}