<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class AdminController extends AnnuaireController
{

  function __construct() { }

  public function selectAll()
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.model.php');
      $adminModel = new CETCALAdminModel();
      return $adminModel->getAll();
    }
    catch (Exception $e) 
    {
      var_dump($e);
    }
    return false;
  }

  public function selectBySessionId($session_id)
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.model.php');
      $adminModel = new CETCALAdminModel();
      return $adminModel->getAdministrateurBySessionId($session_id);
    }
    catch (Exception $e) 
    {
      var_dump($e);
    }
    return false;
  }

  public function selectAllActivite()
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.hist.action.model.php');
      $model = new CETCALAdminHistoriqueActionModel();
      return $model->getAll();
    }
    catch (Exception $e) 
    {
      var_dump($e);
    }
    return false;
  }  

}