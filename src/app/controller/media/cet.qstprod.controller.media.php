<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class MediaController extends AnnuaireController
{

  function __construct() { }

  public function selectMediasProducteur($pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
    $model = new QSTPRODMediaModel();
    $data = $model->select($pk);
    return $data;
  }

  public function selectSrcLogoFemreProducteur($pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
    $model = new QSTPRODMediaModel();
    $data = $model->selectSrcLogoFerme($pk);
    return $data;
  }

  public function selectMediasEntite($pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
    $model = new QSTPRODMediaModel();
    $data = $model->selectMediasEntite($pk);
    return $data;
  }

  public function selectSrcLogoEntite($pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
    $model = new QSTPRODMediaModel();
    $data = $model->selectSrcLogoEntite($pk);
    return $data;
  }

  public function deleteMediaProducteur($id, $pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
    $model = new QSTPRODMediaModel();
    $model->deleteMediaProductuer($id, $pk);
    return true;
  }

  public function deleteMediaEntite($id, $pk)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
    $model = new QSTPRODMediaModel();
    $model->deleteMediaEntite($id, $pk);
    return true;
  }

}