<?php
/**
 * Sql query's.
 */
class CETCALTransactionsLibrary
{
  const USE_CETCAL = "use cetcal;";
  const START_TRANSACTION = "START TRANSACTION;";
  const COMMIT = "COMMIT;";
  const ROLLBACK = "ROLLBACK;";

  const DELETE_PHYSIQUE_DONNEES_PRODUCTEUR_BY_PK = [
    "DELETE cetcal.producteur_join_lieu.*, cetcal.cetcal_lieu.* FROM cetcal.producteur_join_lieu INNER JOIN cetcal.cetcal_lieu ON cetcal.producteur_join_lieu.fk_lieu=cetcal.cetcal_lieu.pk_lieu WHERE cetcal.producteur_join_lieu.fk_producteur_join=%d;",
    "DELETE cetcal.producteur_join_produits.*, cetcal.cetcal_produit.* FROM cetcal.producteur_join_produits INNER JOIN cetcal.cetcal_produit ON cetcal.producteur_join_produits.fk_produits_join=cetcal.cetcal_produit.pk_produit WHERE cetcal.producteur_join_produits.fk_producteur_join=%d;",
    "DELETE FROM cetcal.cetcal_type_production WHERE fk_producteur_type_production=%d;",
    "DELETE FROM cetcal.cetcal_specificite_produits WHERE fk_producteur_specificites_produits=%d;",
    "DELETE FROM cetcal.cetcal_sondage WHERE fk_producteur_sondage=%d;",
    "DELETE FROM cetcal.cetcal_mode_conso WHERE fk_producteur_mode_conso=%d;",
    "DELETE FROM cetcal.cetcal_mode_conso WHERE fk_producteur_mode_conso=%d;",
    "DELETE FROM cetcal.cetcal_information_producteur WHERE fk_producteur_information_producteur=%d;",
    "DELETE FROM cetcal.cetcal_producteur_lieu_dist WHERE fk_producteur=%d;"
  ];

  public function build($queries, $pk_producteur)
  {
    $transac = array();
    array_push($transac, CETCALTransactionsLibrary::USE_CETCAL);
    array_push($transac, CETCALTransactionsLibrary::START_TRANSACTION);
    foreach ($queries as $q) array_push($transac, sprintf($q, $pk_producteur));
    array_push($transac, CETCALTransactionsLibrary::COMMIT);
    error_log("[CETCALTransactionsLibrary->build] requete=".var_dump($transac));
    
    return $transac;
  }

}