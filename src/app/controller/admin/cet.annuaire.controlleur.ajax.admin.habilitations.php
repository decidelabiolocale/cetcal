<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.model.php');
$dataProcessor = new HTTPDataProcessor();
$mdl = new CETCALAdminModel();
 
$action = $dataProcessor->processHttpFormData($_POST['action']); 
$pkadm = $dataProcessor->processHttpFormData($_POST['pkadm']);
$hab_producteurs = $dataProcessor->processHttpFormData($_POST['hab_producteurs']);
$hab_certif_bioab = $dataProcessor->processHttpFormData($_POST['hab_certif_bioab']);
$hab_entites = $dataProcessor->processHttpFormData($_POST['hab_entites']);
$hab_geoloc = $dataProcessor->processHttpFormData($_POST['hab_geoloc']);
$hab_admins = $dataProcessor->processHttpFormData($_POST['hab_admins']);
$hab_histo = $dataProcessor->processHttpFormData($_POST['hab_histo']);

if (strcmp($action, 'update') === 0) 
{
  $mdl->updateHabilitations($pkadm, $hab_producteurs, $hab_certif_bioab, $hab_entites, 
  $hab_geoloc, $hab_admins, $hab_histo);
}
else if (strcmp($action, 'desactiver') === 0)
{
  $mdl->desactiverAdminByPk($pkadm);
}