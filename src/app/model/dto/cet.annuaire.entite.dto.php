<?php
/** 
 * DTO cetcal.cetcal_entite
 */
Class AnnuaireEntiteDTO
{

  public $lat;
  public $lng;
  public $pk;
  
  public $fkProducteur;
  public $fkLieu;
  public $fkProduit;

  public $denomination;
  public $territoire;
  public $activite;
  public $adresse;
  public $tels;
  public $personne;
  public $email;
  public $urlwww;
  public $infoscmd;
  public $jourhoraire;
  public $specificites;
  public $type;
  public $typeLibelle;
  public $etat;

  function __construct($p_denomination = "", $p_territoire = "", $p_activite = "", $p_adresse = "", 
    $p_tels = "", $p_personne = "", $p_email = "", 
    $p_urlwww = "", $p_infoscmd = "", $p_jourhoraire = "", $p_specificites = "", $p_type = "", $p_etat = 0)
  {
      $this->denomination = $p_denomination;
      $this->territoire = $p_territoire;
      $this->activite = $p_activite;
      $this->adresse = $p_adresse;
      $this->tels = $p_tels;
      $this->personne = $p_personne;
      $this->email = $p_email;
      $this->urlwww = $p_urlwww;
      $this->infoscmd = $p_infoscmd;
      $this->jourhoraire = $p_jourhoraire;
      $this->specificites = $p_specificites;
      $this->type = $p_type;
      $this->etat = $p_etat;
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

  public function getLat()
  {
    return $this->lat;
  }

  public function getLng()
  {
    return $this->lng;
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