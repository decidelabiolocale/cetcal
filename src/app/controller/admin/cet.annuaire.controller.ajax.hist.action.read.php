<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.hist.action.model.php');
$mdl = new CETCALAdminHistoriqueActionModel();
$data = $mdl->getAll();
echo json_encode($data);
exit();