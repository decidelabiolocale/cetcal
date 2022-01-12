<?php
/**
 * Controle pour données carto.
 */
class CETCALCartographieController
{

  function __construct() { }

  public function fetchDataCartographie($selectNonInscrits) 
  {
    $result = array();
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/admin/cet.qstprod.admin.cartographie.loader.php');
    $model = new QSTPRODProducteurModel();
    $result_inscrits = $model->fetchAllFrontEndDTOArray();
    $result_preinscrits = $selectNonInscrits ? $model->fetchAllFrontEndDTOArrayPreInscrits() : [];
    $result = array_merge($result_preinscrits, $result_inscrits);
    $loader = new CETCALCartographieLoader();

    return $loader->load($result);
  }

  public function fetchDataCartographieEntite() 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/admin/cet.qstprod.admin.cartographie.loader.php');
    $model = new CETCALEntitesModel();
    $data = $model->selectAllDataToDTOArray();
    $loader = new CETCALCartographieLoader();

    return $loader->loadEntites($data);
  }

}