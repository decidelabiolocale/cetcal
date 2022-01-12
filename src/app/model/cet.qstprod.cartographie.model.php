<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALCartographieModel extends CETCALModel 
{

  public function getLatLng($pFk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK);
    $stmt->bindParam(":pFkProducteur", $pFk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(); 

    return $data;
  }

  public function updateManuelLatLng($pFk, $latLng)
  {
    $update_man = 'true';
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_LAT_LNG_CETCAL_CARTOGRAPHIE_WHERE_PKFK);
    $stmt->bindParam(":pFkProducteur", $pFk, PDO::PARAM_INT);
    $stmt->bindParam(":pLat", $latLng[1], PDO::PARAM_STR);
    $stmt->bindParam(":pLng", $latLng[0], PDO::PARAM_STR);
    $stmt->bindParam(":pUpdateManuelle", $update_man, PDO::PARAM_STR);
    $stmt->execute();
  }

  public function updateManuelLatLngEntite($pFk, $latLng)
  {
    $update_man = 'true';
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_LAT_LNG_ENTITE_CETCAL_CARTOGRAPHIE_WHERE_PKFK);
    $stmt->bindParam(":pFkEntite", $pFk, PDO::PARAM_INT);
    $stmt->bindParam(":pLat", $latLng[1], PDO::PARAM_STR);
    $stmt->bindParam(":pLng", $latLng[0], PDO::PARAM_STR);
    $stmt->bindParam(":pUpdateManuelle", $update_man, PDO::PARAM_STR);
    $stmt->execute();
  }

  public function exists($pFk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_COUNT_CRT_WHERE_PKFK);
    $stmt->bindParam(":pFkProducteur", $pFk, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function insert($latLng, $fk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_CARTOGRAPHIE);
    $stmt->bindParam(":pLat", $latLng[0], PDO::PARAM_STR);
    $stmt->bindParam(":pLng", $latLng[1], PDO::PARAM_STR);
    $stmt->bindParam(":pFkProducteur", $fk, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function getLatLngEntite($pFk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK_ENTITE);
    $stmt->bindParam(":pFkEntite", $pFk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(); 

    return $data;
  }

  public function existsEntite($pFk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_COUNT_CRT_WHERE_PKFK_ENTITE);
    $stmt->bindParam(":pFkEntite", $pFk, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function insertEntite($latLng, $fk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_ENTITE_CARTOGRAPHIE);
    $stmt->bindParam(":pLat", $latLng[0], PDO::PARAM_STR);
    $stmt->bindParam(":pLng", $latLng[1], PDO::PARAM_STR);
    $stmt->bindParam(":pFkEntite", $fk, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function deleteEntite($fk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::DELETE_CETCAL_ENTITE_CARTOGRAPHIE);
    $stmt->bindParam(":pFkEntite", $fk, PDO::PARAM_INT);
    $stmt->execute(); 
  }

  public function deleteProducteur($fk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::DELETE_CETCAL_PRODUCTEUR_CARTOGRAPHIE);
    $stmt->bindParam(":pFkProducteur", $fk, PDO::PARAM_INT);
    $stmt->execute(); 
  }

  public function deleteForceProducteur($fk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::DELETE_CETCAL_PRODUCTEUR_CARTOGRAPHIE_FORCE);
    $stmt->bindParam(":pFkProducteur", $fk, PDO::PARAM_INT);
    $stmt->execute(); 
  }

}