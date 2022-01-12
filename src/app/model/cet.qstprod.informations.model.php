<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODInformationsModel extends CETCALModel 
{

  public function gestionEnvoiQstprod($pPK, $pBesoinsDto, $contextMdifGlobal, $pk_mdif)
  {
    $this->createInformations($contextMdifGlobal ? $pk_mdif : $pPK, $pBesoinsDto);
  }

  /* *************************************************************************************************
   * fonctions privées.
   */
  
  private function createInformations($pPK, $pBesoinsDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupbesoins.dto.php');
    $dtoBesoins = new QstBesoinsDTO();
    $dtoBesoins = unserialize($pBesoinsDto);
    
    if (isset($dtoBesoins->reseauxSolidariteAutre) && strlen($dtoBesoins->reseauxSolidariteAutre) > 0) array_push($dtoBesoins->reseauxSolidarite, "sl01;".$dtoBesoins->reseauxSolidariteAutre);
    foreach ($dtoBesoins->reseauxSolidarite as $ressol) 
    {
      $qrinformation = explode(";", $ressol);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_INFORMATION);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefInformation", $qrinformation[0], PDO::PARAM_STR);
      $stmt->bindParam(":pInformation", $qrinformation[1], PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoBesoins->actionBesoinAutre) && strlen($dtoBesoins->actionBesoinAutre) > 0) array_push($dtoBesoins->actionsBesoins, "sl02;".$dtoBesoins->actionBesoinAutre);
    foreach ($dtoBesoins->actionsBesoins as $actbesoin) 
    {
      $qrinformation = explode(";", $actbesoin);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_INFORMATION);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefInformation", $qrinformation[0], PDO::PARAM_STR);
      $stmt->bindParam(":pInformation", $qrinformation[1], PDO::PARAM_STR);
      $stmt->execute();
    }

    $clefGroupeReflexion = "sr01";
    if (isset($dtoBesoins->groupeReflexionAutre) && strlen($dtoBesoins->groupeReflexionAutre) > 0) array_push($dtoBesoins->groupesReflexion, "sr01;".$dtoBesoins->groupeReflexionAutre);
    foreach ($dtoBesoins->groupesReflexion as $grpreflx) 
    {
      $qrinformation = explode(";", $grpreflx);
      $clefGroupeReflexion = $qrinformation[0];
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_INFORMATION);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefInformation", $qrinformation[0], PDO::PARAM_STR);
      $stmt->bindParam(":pInformation", $qrinformation[1], PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoBesoins->souhaiteParticiper) && strlen($dtoBesoins->souhaiteParticiper) > 0) 
    {
      $clefQuestionAction = "srq1";
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_INFORMATION);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefInformation", $clefQuestionAction, PDO::PARAM_STR);
      $stmt->bindParam(":pInformation", $dtoBesoins->souhaiteParticiper, PDO::PARAM_STR);
      $stmt->execute();
    }

  }

}