<?php
/** 
 * signuplieuxdist.form html form DTO.
 */
Class QstLieuxDistributionDTO
{

  /**
   * Exmeple de contenu JSON :
   {"lieux":[{"denomination":"oipoiopi","type":"March\xc3\xa9","crea_marche":true,"precs":"joijoijoij","date":"08/04/2021","heure_deb":"04:30","heure_fin":"04:00","jour":"jeudi","adr":"iopipoipoi"},{"denomination":"March\xc3\xa9 de Targon","type":"March\xc3\xa9","sous_type":null,"pk_entite":"99","crea_marche":false,"precs":"","date":null,"heure_deb":null,"heure_fin":null,"jour":null},{"denomination":"TODO","type":"Reseau de vente en circuit court","sous_type":"groupement d\xe2\x80\x99achat","pk_entite":null,"crea_marche":false,"precs":"ijoijpoijpoij","date":null,"heure_deb":null,"heure_fin":null,"jour":null}]}
   */
  public $json;

  function __construct($pJson = "")
  {
    $this->json = $pJson;
  }

}