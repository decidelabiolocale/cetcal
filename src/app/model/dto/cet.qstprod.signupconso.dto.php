<?php
/** 
 * signupconso.form html form DTO.
 */
Class QstConsomateursDTO
{

  public $consoachats;
  public $consoachatsAutre;
  public $receptions;
  public $receptionAutre;
  public $paiments;
  public $paimentAutre;
  public $driveadr;
  public $drivejour;

  function __construct($pConsoachats = "", $pConsoachatsAutre = "",
    $pReceptions = "", $pReceptionAutre = "", $pPaiments = "", 
    $pPaimentAutre = "", $pDriveAdr = "", $pDriveJour = "")
  {
    $this->consoachats = $pConsoachats;
    $this->consoachatsAutre = $pConsoachatsAutre;
    $this->receptions = $pReceptions;
    $this->receptionAutre = $pReceptionAutre;
    $this->paiments = $pPaiments;
    $this->paimentAutre = $pPaimentAutre;
    $this->driveadr = $pDriveAdr;
    $this->drivejour =$pDriveJour;
  }

}