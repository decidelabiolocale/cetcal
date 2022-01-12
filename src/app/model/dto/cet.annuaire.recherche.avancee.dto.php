<?php
/** 
 * DTO cetcal.cetcal_entite
 */
Class AnnuaireDTO
{

  public $lat;
  public $lng;
  public $pk;

  public $isProducteur;
  public $isEntite;

  public $denomination;
  public $adresse;

  function __construct()
  {
      $this->denomination = $p_denomination;
      $this->adresse = $p_adresse;
  }

  public function setLatLng($pLat = NULL, $pLng = NULL)
  {
    $this->lat = $pLat;
    $this->lng = $pLng;
  }

  public function getLatLng()
  {
    return $this->lat.'/'.$this->lng;
  }

  public function setPk($pPk) 
  {
    $this->pk = $pPk;
  }

  public function getPk()
  {
    return $this->pk;
  }

}