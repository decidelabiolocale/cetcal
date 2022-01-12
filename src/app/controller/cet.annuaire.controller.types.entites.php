<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.types.php');
$model = new CETCALEntitesModel();
$data = $model->selectDistinctTypes();
echo json_encode($data);