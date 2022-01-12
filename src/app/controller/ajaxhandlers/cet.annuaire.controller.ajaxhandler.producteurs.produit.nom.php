<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PATH_MODEL = $DOC_ROOT.'/src/app/model/';
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
require_once($PATH_MODEL.'cet.qstprod.producteurs.model.php');
$model = new QSTPRODProducteurModel();
$pks = array();

if (!isset($_GET['prds']) || empty($_GET['prds'])) 
{
  echo json_encode(['err' => 'Aucun producteur.e trouvé.']);
  return;
}
else
{
  $produits = $dataProcessor->processHttpFormData($_GET['prds']);
  error_log("[lookup producteurs par produits] produits=".$produits);
  $prds = explode(';', $produits);
  foreach ($prds as $produit) $pks = array_merge($pks, 
    $model->pksProducteursParNomProduit($produit, false));
}

$producteur = $model->findProducteursINPkArray(array_unique($pks));
$check_array = array();
$checked_array = array();
foreach ($producteur as $tmp) 
{
  if (in_array($tmp->nom_ferme, $check_array)) continue;
  array_push($check_array, $tmp->nom_ferme);
  array_push($checked_array, $tmp);
}

if (count($checked_array) > 0) echo json_encode($checked_array);
else echo json_encode(['err' => 'Aucun producteur.e trouvé.']);
return;