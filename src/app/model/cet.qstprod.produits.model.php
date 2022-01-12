<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODProduitsModel extends CETCALModel 
{
  
  public function gestionEnvoiQstprod($pPK, $pProduitsDto, $contextMdifGlobal, $pk_mdif)
  {
    $this->createProduits($contextMdifGlobal ? $pk_mdif : $pPK, $pProduitsDto);
  }

  /* *************************************************************************************************
   * fonctions privées.
   */

  private function createProduits($pPK, $pProduitsDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupprods.dto.php');
    $dtoproduits = new QstProduitDTO();
    $dtoproduits = unserialize($pProduitsDto);
    $pks_produits = array();
    
    if (isset($dtoproduits->legumeAutre) && strlen($dtoproduits->legumeAutre) > 0) array_push($dtoproduits->legumes, "pl01;".$dtoproduits->legumeAutre);
    $cat = "legume";
    foreach ($dtoproduits->legumes as $legume) 
    {
      $data = explode(";", $legume);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->viandeAutre) && strlen($dtoproduits->viandeAutre) > 0) array_push($dtoproduits->viandes, "pv01;".$dtoproduits->viandeAutre);
    $cat = "viande";
    foreach ($dtoproduits->viandes as $viande) 
    {
      $data = explode(";", $viande);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->laitierAutre) && strlen($dtoproduits->laitierAutre) > 0) array_push($dtoproduits->laitiers, "pla1;".$dtoproduits->laitierAutre);
    $cat = "laitier";
    foreach ($dtoproduits->laitiers as $laitier) 
    {
      $data = explode(";", $laitier);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->rucheAutre) && strlen($dtoproduits->rucheAutre) > 0) array_push($dtoproduits->ruches, "pr01;".$dtoproduits->rucheAutre);
    $cat = "ruche";
    foreach ($dtoproduits->ruches as $ruche) 
    {
      $data = explode(";", $ruche);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->fruitAutre) && strlen($dtoproduits->fruitAutre) > 0) array_push($dtoproduits->fruits, "pf01;".$dtoproduits->fruitAutre);
    $cat = "fruit";
    foreach ($dtoproduits->fruits as $fruit) 
    {
      $data = explode(";", $fruit);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->champignonAutre) && strlen($dtoproduits->champignonAutre) > 0) array_push($dtoproduits->champignons, "pc01;".$dtoproduits->champignonAutre);
    $cat = "champignon";
    foreach ($dtoproduits->champignons as $champignon) 
    {
      $data = explode(";", $champignon);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->poissonAutre) && strlen($dtoproduits->poissonAutre) > 0) array_push($dtoproduits->poissons, "ppc1;".$dtoproduits->poissonAutre);
    $cat = "poisson";
    foreach ($dtoproduits->poissons as $poisson) 
    {
      $data = explode(";", $poisson);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->planteAutre) && strlen($dtoproduits->planteAutre) > 0) array_push($dtoproduits->plantes, "pp01;".$dtoproduits->planteAutre);
    $cat = "plante";
    foreach ($dtoproduits->plantes as $plante) 
    {
      $data = explode(";", $plante);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->semenceAutre) && strlen($dtoproduits->semenceAutre) > 0) array_push($dtoproduits->semences, "ps01;".$dtoproduits->semenceAutre);
    $cat = "semence";
    foreach ($dtoproduits->semences as $semence) 
    {
      $data = explode(";", $semence);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->transformeAutre) && strlen($dtoproduits->transformeAutre) > 0) array_push($dtoproduits->transformes, "pt01;".$dtoproduits->transformeAutre);
    $cat = "transforme";
    foreach ($dtoproduits->transformes as $transforme) 
    {
      $data = explode(";", $transforme);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->cerealeAutre) && strlen($dtoproduits->cerealeAutre) > 0) array_push($dtoproduits->cereales, "pcr1;".$dtoproduits->cerealeAutre);
    $cat = "cereal";
    foreach ($dtoproduits->cereales as $cereale) 
    {
      $data = explode(";", $cereale);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->hygieneAutre) && strlen($dtoproduits->hygieneAutre) > 0) array_push($dtoproduits->hygienes, "phy1;".$dtoproduits->hygieneAutre);
    $cat = "hygiene";
    foreach ($dtoproduits->hygienes as $hygiene) 
    {
      $data = explode(";", $hygiene);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->entretienAutre) && strlen($dtoproduits->entretienAutre) > 0) array_push($dtoproduits->entretiens, "pnt1;".$dtoproduits->entretienAutre);
    $cat = "entretien";
    foreach ($dtoproduits->entretiens as $entretien) 
    {
      $data = explode(";", $entretien);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->nourritureAnimauxAutre) && strlen($dtoproduits->nourritureAnimauxAutre) > 0) array_push($dtoproduits->nourritureAnimaux, "pna1;".$dtoproduits->nourritureAnimauxAutre);
    $cat = "nourriture animaux";
    foreach ($dtoproduits->nourritureAnimaux as $naniamux) 
    {
      $data = explode(";", $naniamux);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    if (isset($dtoproduits->boissonAutre) && strlen($dtoproduits->boissonAutre) > 0) array_push($dtoproduits->boissons, "pb01;".$dtoproduits->boissonAutre);
    $cat = "boisson";
    foreach ($dtoproduits->boissons as $boisson) 
    {
      $data = explode(";", $boisson);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $data[1], PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $data[0], PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    $cat = "autre";
    if (isset($dtoproduits->autreProduitInconnu) && strlen($dtoproduits->autreProduitInconnu) > 0) 
    {
      $autreAutreClef = 'aap1';
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUIT);
      $stmt->bindParam(":pNom", $dtoproduits->autreProduitInconnu, PDO::PARAM_STR);
      $stmt->bindParam(":pClef", $autreAutreClef, PDO::PARAM_STR);
      $stmt->bindParam(":pCategorie", $cat, PDO::PARAM_STR);
      $stmt->execute();
      array_push($pks_produits, $this->getCnxdb()->lastInsertId());
    }

    foreach ($pks_produits as $pkproduit)
    {
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_PRODUCTEUR_JOIN_PRODUITS);
      $stmt->bindParam(":pFkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pFkProduit", $pkproduit, PDO::PARAM_INT);
      $stmt->execute();
    }

  }
  
}