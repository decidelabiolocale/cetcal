<?php
include $_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.filereader.php';
$fileReader = new FileReaderUtils($_SERVER['DOCUMENT_ROOT']);
$data = $fileReader->read('cet.annuaire.liste.csv.entites');
$marches_data = $fileReader->read('marches.region.castillonnais');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
$model = new CETCALEntitesModel();
$model->insert($data);
$model->insertMarches($marches_data);