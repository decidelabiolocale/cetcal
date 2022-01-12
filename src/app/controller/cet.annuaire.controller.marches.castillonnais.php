<?php
require_once('cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class MarchesCastillonnaisController extends AnnuaireController
{

  function __construct() { }

  public function init($type) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
    $model = new CETCALEntitesModel();
    $data = $model->selectAllByType($type);
    return $data;
  }

  public function selectAll() 
  {
  	require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
    $model = new CETCALEntitesModel();
    $data = $model->selectAll();
    return $data;
  }

  public function selectAllByType($type) 
  {
  	require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
    $model = new CETCALEntitesModel();
    $data = $model->selectAllByType($type);
    return $data;
  }

  public function showAllTypes()
  {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      $data = $model->selectTypes();
      return $data;
  }


    public function selectAllMarche()
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
        $model = new CETCALEntitesModel();
        $data = $model->selectAllIsMarche();
        return $data;
    }

    public function nomDesMarches()
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
        $model = new CETCALEntitesModel();
        $data = $model->getAllmarcheDenomination();
        return $data;

    }
  
}