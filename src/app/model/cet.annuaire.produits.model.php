<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class AnnuaireProduitsModel extends CETCALModel 
{

  public function selectAllDistinctLibellesProduits()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_DISTINCT_NOMS_PRODUITS);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function countProduits($produits, $pk_producteur)
  {
    $qLib = $this->getLookupsLib();
    $query = str_replace("[PK_PRODUCTEUR]", $pk_producteur, 
      $qLib::COUNT_PRODUITS_FOR_PK_PRODUCTEUR_NOMS_PRODUITS);
    $in_produits = '';
    foreach ($produits as $p) $in_produits .= "'".$p."',";
    $query = str_replace("[IN_PRODUITS]", substr($in_produits, 0, -1), $query);
    $stmt = $this->getCnxdb()->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return count($data);
  }

}