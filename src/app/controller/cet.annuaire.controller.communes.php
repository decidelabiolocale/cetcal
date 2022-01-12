<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.communes.model.php');
$model = new CETCALCommunesModel();
$data = $model->selectAllGeolocSetByCodeDept(["33", "24", "47", "40"]);
echo json_encode($data);