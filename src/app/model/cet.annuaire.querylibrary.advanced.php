<?php
/**
 * Sql query's de type avancées.
 */
class CETCALAdvancedQueryLibrary
{

  const SELECT_PKS_PRODUCTEUR_BY_NOM_PRODUIT_WILCARDS = "SELECT distinct(prd.pk_producteur) FROM cetcal.cetcal_producteur prd, cetcal.cetcal_produit p, cetcal.producteur_join_produits j WHERE 1=1 AND p.pk_produit=j.fk_produits_join AND j.fk_producteur_join=prd.pk_producteur AND p.nom LIKE CONCAT('%', :pNomProduit, '%');";
  const SELECT_PKS_PRODUCTEUR_BY_NOM_PRODUIT = "SELECT distinct(prd.pk_producteur) FROM cetcal.cetcal_producteur prd, cetcal.cetcal_produit p, cetcal.producteur_join_produits j WHERE 1=1 AND p.pk_produit=j.fk_produits_join AND j.fk_producteur_join=prd.pk_producteur AND p.nom=:pNomProduit;";

  const SELECT_CETCAL_PRODUCTEUR_IN_PKS = "SELECT * from cetcal.cetcal_producteur WHERE pk_producteur IN ([pks]);";

  const COUNT_PRODUITS_FOR_PK_PRODUCTEUR_NOMS_PRODUITS = "SELECT * FROM cetcal.cetcal_produit WHERE pk_produit IN (SELECT fk_produits_join FROM cetcal.producteur_join_produits WHERE fk_producteur_join=[PK_PRODUCTEUR]) AND nom IN ([IN_PRODUITS]);";

}