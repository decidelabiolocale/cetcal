<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.filereader.php');
require_once($DOC_ROOT.'/src/app/model/cet.annuaire.recette.model.php');
$model = new CETCALRecetteModel();
$freader = new FileReaderUtils($DOC_ROOT);
$files1 = $freader->listFiles($DOC_ROOT.'/res/data/datafiles/recettes/cet');
$files2 = $freader->listFiles($DOC_ROOT.'/res/data/datafiles/recettes/antigaspi_cet');
$files = array_merge($files1, $files2);

foreach ($files as $file) 
{
  $marker = '';
  $tmp = [
    "titre" => "",
    "nombre_personnes" => "",
    "temps_cuisson" => "",
    "temps_preparation" => "",
    "ingredients" => "",
    "recette" => "",
    "ingredients_et_recette" => "",
    "notes" => "",
    "auteurs" => "",
    "file_path" => "",
    "mots_cles_produits" => ""
  ];

  foreach ($freader->readFromCannonicalPath($file) as $line) 
  {
    if (substr($line, 0, 6) === "#mark/") $marker = substr($line, 6, strlen($line));
    else if (strlen($line) > 0) $tmp[$marker] .= $line.'<br>';
  }

  foreach ($tmp as $key => $value) 
  {
     if (strlen($tmp[$key]) > 0) $tmp[$key] = substr($value, 0, strlen($value) - 4);
  }

  $tmp['file_path'] = $file;
  $model->insertFromArray($tmp);
}