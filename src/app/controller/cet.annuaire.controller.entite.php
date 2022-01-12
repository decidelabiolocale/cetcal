<?php
require_once('cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class EntiteController extends AnnuaireController
{

  function __construct() { }

  public function getDistinctTypesEntites()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
    $model = new CETCALEntitesModel();
    return $model->selectDistinctTypes();
  }

}