<?php 
Class CetAnnuaireConstTypes
{

  const TYPE_ENTITE = [
    "assocdist" => "Association distributeur",
    "mbio" => "Magasin BIO",
    "amap" => "AMAP",
    "autre" => "Autre",
    "marche" => "Marché",
    "" => "Tous..."
  ];

  /**
   * Mapping des type cetcal_entite sur les code type cetcal_type_lieu.
   * à gauche les code_type ou code_sous_type de la table cetcal_type_lieu, à droite le cetcal_entite.type.
   */
  const TRANSCO_TYPE_ENTITE = [
    "mprd" => "''",
    "mbio" => "'mbio'",
    "amap" => "'amap'",
    "rvcc" => "'amap'",
    "mrch" => "'marche'",
    "ascd" => "'assocdist'"
  ];
  
}