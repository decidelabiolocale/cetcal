<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$err = isset($_GET['err']) ? $dataProcessor->processHttpFormData($_GET['err']) : "Erreure technique rencontrée.";
$cetcal_session_id = isset($_GET['sitkn']) ? $dataProcessor->processHttpFormData($_GET['sitkn']) : "";
header('Location: /?statut=generique.erreur&sitkn='.$cetcal_session_id.'&err='.$err);
exit();