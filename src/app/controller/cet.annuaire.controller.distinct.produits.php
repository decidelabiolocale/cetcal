<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.produits.model.php');
$model = new AnnuaireProduitsModel();
$data = $model->selectAllDistinctLibellesProduits();
echo json_encode($data);