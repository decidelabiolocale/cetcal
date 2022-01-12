<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALPartenairesLiensModel extends CETCALModel 
{

  public function selectAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_PARTENAIRES_LIENS);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

}