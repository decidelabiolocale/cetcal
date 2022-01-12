<?php
require_once('cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');

/**
 *
 */
class FormLieuDistController extends AnnuaireController 
{

  public function fetchAllTypeLieuxDistinctType()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.lieuxdist.model.php');
    $model = new QSTPRODLieuModel();
    $data = $model->allLieuDistDistinctType();
    return $data;
  }


}


