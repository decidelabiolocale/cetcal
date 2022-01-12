<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODLieuxModel extends CETCALModel 
{
  
  public function gestionEnvoiQstprod($pPK, $pLieuDto, $pConsoDto, $contextMdifGlobal, $pk_mdif)
  {
    $this->createLieu($contextMdifGlobal ? $pk_mdif : $pPK, $pLieuDto, $pConsoDto);
  }

  /* *************************************************************************************************
   * fonctions privées.
   */

  private function createLieu($pPK, $pLieuDto, $pConsoDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupconso.dto.php');
    $dtoLieux = new QstLieuxDistributionDTO();
    $dtoLieux = unserialize($pLieuDto);
    $dtoConso = new QstConsomateursDTO();
    $dtoConso = unserialize($pConsoDto);
    $null = "";
    $pks_lieux = array();
    $qLib = $this->getQuerylib();

    foreach ($dtoLieux->pointsDeVente as $point) 
    {
      $pointvente = explode(';', $point);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_LIEU);
      $stmt->bindParam(":pNom", $pointvente[1], PDO::PARAM_STR);
      $stmt->bindParam(":pAdrLit", $null, PDO::PARAM_STR);
      $stmt->bindParam(":pJoursProducteur", $null, PDO::PARAM_STR);
      $stmt->bindParam(":pJourCollecteConso", $null, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_lieux, $this->getCnxdb()->lastInsertId());
    }     

    if (strlen($dtoLieux->pointsDeVenteAutre) > 0) 
    {
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_LIEU);
      $stmt->bindParam(":pNom", $dtoLieux->pointsDeVenteAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pAdrLit", $null, PDO::PARAM_STR);
      $stmt->bindParam(":pJoursProducteur", $null, PDO::PARAM_STR);
      $stmt->bindParam(":pJourCollecteConso", $null, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_lieux, $this->getCnxdb()->lastInsertId());
    }

    foreach ($dtoConso->receptions as $recep)
    {
      $crecep = explode(';', $recep);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_LIEU);
      $stmt->bindParam(":pNom", $crecep[1], PDO::PARAM_STR);
      $stmt->bindParam(":pAdrLit", $null, PDO::PARAM_STR);
      $stmt->bindParam(":pJoursProducteur", $null, PDO::PARAM_STR);
      $stmt->bindParam(":pJourCollecteConso", $null, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_lieux, $this->getCnxdb()->lastInsertId());
    }

    if (strlen($dtoConso->driveadr) > 0)
    {
      $nomRecep = "drv1";
      $driveJours = "";
      if (isset($dtoConso->drivejour) && is_array($dtoConso->drivejour))
      {
        foreach ($dtoConso->drivejour as $jour) $driveJours = $driveJours."[".explode(';', $jour)[1]."]";
      }

      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_LIEU);
      $stmt->bindParam(":pNom", $nomRecep, PDO::PARAM_STR);
      $stmt->bindParam(":pAdrLit", $dtoConso->driveadr, PDO::PARAM_STR);
      $stmt->bindParam(":pJoursProducteur", $driveJours, PDO::PARAM_STR);
      $stmt->bindParam(":pJourCollecteConso", $driveJours, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_lieux, $this->getCnxdb()->lastInsertId());
    }

    $nomMarche = "mad1";
    $marcheJours = "";
    if (strlen($dtoLieux->marcheAdr) > 0) 
    {
      if (isset($dtoLieux->marcheJours) && is_array($dtoLieux->marcheJours))
      {
        foreach ($dtoLieux->marcheJours as $jour) $marcheJours = $marcheJours."[".explode(';', $jour)[1]."]";
      }

      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_LIEU);
      $stmt->bindParam(":pNom", $nomMarche, PDO::PARAM_STR);
      $stmt->bindParam(":pAdrLit", $dtoLieux->marcheAdr, PDO::PARAM_STR);
      $stmt->bindParam(":pJoursProducteur", $marcheJours, PDO::PARAM_STR);
      $stmt->bindParam(":pJourCollecteConso", $marcheJours, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_lieux, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoLieux->joursMarchesSaisies) && is_array($dtoLieux->joursMarchesSaisies)) 
    {
      foreach ($dtoLieux->joursMarchesSaisies as $marcheSaisie)
      {
        $marche = explode(';', $marcheSaisie);
        $jours = substr($marche[1], strrpos($marche[1], '('), strlen($marche[1]));
        $jours = str_replace("(", "[", $jours);
        $jours = str_replace(")", "]", $jours);
        $jours = str_replace(" ,", "][", $jours);
        $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_LIEU);
        $stmt->bindParam(":pNom", $marche[0], PDO::PARAM_STR);
        $stmt->bindParam(":pAdrLit", $marche[1], PDO::PARAM_STR);
        $stmt->bindParam(":pJoursProducteur", $jours, PDO::PARAM_STR);
        $stmt->bindParam(":pJourCollecteConso", $jours, PDO::PARAM_STR);
        $stmt->execute();
        array_push($pks_lieux, $this->getCnxdb()->lastInsertId());
      }
    }

    foreach ($pks_lieux as $pklieu)
    {
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_PRODUCTEUR_JOIN_LIEU);
      $stmt->bindParam(":pFkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pFkLieu", $pklieu, PDO::PARAM_INT);
      $stmt->execute();
    }
  }

}