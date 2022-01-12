<?php
/** 
 * signupbesoins.form html form DTO.
 */
Class QstBesoinsDTO
{

  public $reseauxSolidarite;
  public $reseauxSolidariteAutre;
  public $souhaiteParticiper;
  public $actionsBesoins;
  public $actionBesoinAutre;
  public $groupesReflexion;
  public $groupeReflexionAutre;

  function __construct($pReseauxSolidarite = "", $pReseauxSolidariteAutre = "",
    $pSouhaiteParticiper = "", $pActionsBesoins = "", $pActionBesoinAutre = "",
    $pGroupesReflexion = "", $pGroupeReflexionAutre = "")
  {
    $this->reseauxSolidarite = $pReseauxSolidarite;
    $this->reseauxSolidariteAutre = $pReseauxSolidariteAutre;
    $this->souhaiteParticiper = $pSouhaiteParticiper;
    $this->actionsBesoins = $pActionsBesoins;
    $this->actionBesoinAutre = $pActionBesoinAutre;
    $this->groupesReflexion = $pGroupesReflexion;
    $this->groupeReflexionAutre = $pGroupeReflexionAutre;
  }

}