<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.biodata.model.php');
$ctrl = new AnnuaireController();
$biodata_model = new BioDataModel();
$data = $ctrl->fetchAllFrontEndDTOArray();
$count_certifies = 0;
$count_noncertifies = 0;

echo count($data);

try
{
  foreach ($data as $prdDto) 
  {
    $result = $biodata_model->findCertificationAB($prdDto->nom, $prdDto->prenom, $prdDto->nomferme);
    if ($result !== false)
    {
      ++$count_certifies;
      var_dump($result);
      echo '<br>';
    }
    else
    {
      ++$count_noncertifies;
    }
  }

  echo 'Nombre de producteurs certifies='.$count_certifies.'<br>';
  echo 'Nombre de producteurs non certifies='.$count_noncertifies.'<br>';
}
catch (Exception $e)
{
  echo 'oups';
  echo $e->getMessage();
}