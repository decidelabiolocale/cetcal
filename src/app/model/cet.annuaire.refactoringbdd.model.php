<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALrefactoring extends CETCALModel
{

     public function fetchAllProducteurs()
     {
         $qLib = $this->getQuerylib();
         $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR);
         $stmt->execute();
         $data = $stmt->fetchAll(PDO::FETCH_OBJ);

         return $data;
     }

    /**
     * Retourne tous les producteurs qui ont renseigné un marché dans la table producteur_join_lieu
     *
     * @return mixed
     */
     public function fetchProducteursWithMarche() {

         $qLib = $this->getQuerylib();
         $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PRODUCTEUR_WITH_MARCHE);
         $stmt->execute();
         $data = $stmt->fetchAll(PDO::FETCH_OBJ);

         return $data;
     }

    /**
     * Compare le marché renseigné par le producteur au marchés présent dans la table entité
     * et retour un tableau de l'entité si le résultat correspond à la caomparaison.
     *
     * @param string $denomination
     * @return array data
     */

     public function compareMarche($denomination) {

         $q =  explode(" ", $denomination);
         $qLib = $this->getQuerylib();
         $stmt = $this->getCnxdb()->prepare($qLib::SELECT_MARCHE_LIKE);
         $stmt->bindParam(":pDenomination", $q[0], PDO::PARAM_STR);
         $stmt->execute();
         $data = $stmt->fetch(PDO::FETCH_OBJ);

         return $data;
     }

     /**
      * insert bdd fk_producteur, fk_entite
      *
      * @param int fk_producteur
      * @param int fk_entite
      */

     public function insertProducteurLieuDistribution(int $fk_producteur, int $fk_entite){

         $qLib = $this->getQuerylib();
         $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUCTEUR_LIEU_DE_DISTRIBUTION);
         $stmt->bindParam(":pFk_producteur", $fk_producteur, PDO::PARAM_INT);
         $stmt->bindParam(":pFk_entite", $fk_entite, PDO::PARAM_INT);
         $stmt->execute();

     }

}