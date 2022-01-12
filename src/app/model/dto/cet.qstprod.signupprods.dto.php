<?php
/** 
 * signupprods.form html form DTO.
 */
Class QstProduitDTO
{

  public $specificite;
  public $specificiteAutre;
  public $legumes;
  public $legumeAutre;
  public $viandes;
  public $viandeAutre;
  public $laitiers;
  public $laitierAutre;
  public $ruches;
  public $rucheAutre;
  public $fruits;
  public $fruitAutre;
  public $champignons;
  public $champignonAutre;
  public $plantes;
  public $planteAutre;
  public $semences;
  public $semenceAutre;
  public $transformes;
  public $transformeAutre;
  public $cereales;
  public $cerealeAutre;
  public $hygienes;
  public $hygieneAutre;
  public $entretiens;
  public $entretienAutre;
  public $nourritureAnimaux;
  public $nourritureAnimauxAutre;
  public $autreProduitInconnu;
  public $boissons;
  public $boissonAutre;
  public $poissons;
  public $poissonAutre;

  function __construct($pSpecificite = "", $pSpecificiteAutre = "", 
    $pLegumes = "", $pLegumeAutre = "", $pViandes = "",
    $pViandeAutre = "", $pLaitiers = "", $pLaitiersAutre = "", $pRuches = "",
    $pRucheAutre = "", $pFruits = "", $pFruitAutre = "",
    $pChampignons = "", $pChampignonAutre = "", $pPlantes = "", $pPlanteAutre = "",
    $pSemences = "", $pSemenceAutre = "", $pTransformes = "", $pTransformeAutre = "",
    $pCereales = "", $pCerealeAutre = "", $pHygienes = "", $pHygieneAutre = "",
    $pEntretiens = "", $pEntretienAutre = "", $pNourritureAnimaux = "", 
    $pNourritureAnimauxAutre = "", $pAutreInconnu = "", $pBoissons = "", $pBoissonAutre = "",
    $pPoissons = "", $pPoissonAutre = "")
  {
    $this->specificite = $pSpecificite;
    $this->specificiteAutre = $pSpecificiteAutre;
    $this->legumes = $pLegumes;
    $this->legumeAutre = $pLegumeAutre;
    $this->viandes = $pViandes;
    $this->viandeAutre = $pViandeAutre;
    $this->laitiers = $pLaitiers;
    $this->laitierAutre = $pLaitiersAutre;
    $this->ruches = $pRuches;
    $this->rucheAutre = $pRucheAutre;
    $this->fruits = $pFruits;
    $this->fruitAutre = $pFruitAutre;
    $this->champignons = $pChampignons;
    $this->champignonAutre = $pChampignonAutre;
    $this->plantes = $pPlantes;
    $this->planteAutre = $pPlanteAutre;
    $this->semences = $pSemences;
    $this->semenceAutre = $pSemenceAutre;
    $this->transformes = $pTransformes;
    $this->transformeAutre = $pTransformeAutre;
    $this->cereales = $pCereales;
    $this->cerealeAutre =$pCerealeAutre;
    $this->hygienes = $pHygienes;
    $this->hygieneAutre = $pHygieneAutre;
    $this->entretiens = $pEntretiens;
    $this->entretienAutre = $pEntretienAutre;
    $this->nourritureAnimaux = $pNourritureAnimaux;
    $this->nourritureAnimauxAutre = $pNourritureAnimauxAutre;
    $this->autreProduitInconnu = $pAutreInconnu;
    $this->boissons = $pBoissons;
    $this->boissonAutre = $pBoissonAutre;
    $this->poissons = $pPoissons;
    $this->poissonAutre = $pPoissonAutre;
  }

  function listAllProducts()
  {
    $listLegumes = array();
    if (isset($this->legumes) && is_array($this->legumes) && count($this->legumes) > 0)
    {
      foreach ($this->legumes as $v) array_push($listLegumes, explode(';', $v)[1]);
    }
    if (isset($this->legumeAutre) && strlen($this->legumeAutre) > 0) array_push($listLegumes, $this->legumeAutre);
    
    $listViandes = array();
    if (isset($this->viandes) && is_array($this->viandes) && count($this->viandes) > 0)
    {
      foreach ($this->viandes as $v) array_push($listViandes, explode(';', $v)[1]);
    }
    if (isset($this->viandeAutre) && strlen($this->viandeAutre) > 0) array_push($listViandes, $this->viandeAutre);

    $listLaitiers = array();
    if (isset($this->laitiers) && is_array($this->laitiers) && count($this->laitiers) > 0)
    {
      foreach ($this->laitiers as $v) array_push($listLaitiers, explode(';', $v)[1]);
    }
    if (isset($this->laitierAutre) && strlen($this->laitierAutre) > 0) array_push($listLaitiers, $this->laitierAutre);

    $listRuches = array();
    if (isset($this->ruches) && is_array($this->ruches) && count($this->ruches) > 0)
    {
      foreach ($this->ruches as $v) array_push($listRuches, explode(';', $v)[1]);
    }
    if (isset($this->rucheAutre) && strlen($this->rucheAutre) > 0) array_push($listRuches, $this->rucheAutre);

    $listFruits = array();
    if (isset($this->fruits) && is_array($this->fruits) && count($this->fruits) > 0)
    {
      foreach ($this->fruits as $v) array_push($listFruits, explode(';', $v)[1]);
    }
    if (isset($this->fruitAutre) && strlen($this->fruitAutre) > 0) array_push($listFruits, $this->fruitAutre);

    $listChampignons = array();
    if (isset($this->champignons) && is_array($this->champignons) && count($this->champignons) > 0)
    {
      foreach ($this->champignons as $v) array_push($listChampignons, explode(';', $v)[1]);
    }
    if (isset($this->champignonAutre) && strlen($this->champignonAutre) > 0) array_push($listChampignons, $this->champignonAutre);

    $listBoissons = array();
    if (isset($this->boissons) && is_array($this->boissons) && count($this->boissons) > 0)
    {
      foreach ($this->boissons as $v) array_push($listBoissons, explode(';', $v)[1]);
    }
    if (isset($this->boissonAutre) && strlen($this->boissonAutre) > 0) array_push($listBoissons, $this->boissonAutre);

    $listPlantes = array();
    if (isset($this->plantes) && is_array($this->plantes) && count($this->plantes) > 0)
    {
      foreach ($this->plantes as $v) array_push($listPlantes, explode(';', $v)[1]);
    }
    if (isset($this->planteAutre) && strlen($this->planteAutre) > 0) array_push($listPlantes, $this->planteAutre);

    $listSemences = array();
    if (isset($this->semences) && is_array($this->semences) && count($this->semences) > 0)
    {
      foreach ($this->semences as $v) array_push($listSemences, explode(';', $v)[1]);
    }
    if (isset($this->semenceAutre) && strlen($this->semenceAutre) > 0) array_push($listSemences, $this->semenceAutre);

    $listTransformes = array();
    if (isset($this->transformes) && is_array($this->transformes) && count($this->transformes) > 0)
    {
      foreach ($this->transformes as $v) array_push($listTransformes, explode(';', $v)[1]);
    }
    if (isset($this->transformeAutre) && strlen($this->transformeAutre) > 0) array_push($listTransformes, $this->transformeAutre);

    $listCereales = array();
    if (isset($this->cereales) && is_array($this->cereales) && count($this->cereales) > 0)
    {
      foreach ($this->cereales as $v) array_push($listCereales, explode(';', $v)[1]);
    }
    if (isset($this->cerealeAutre) && strlen($this->cerealeAutre) > 0) array_push($listCereales, $this->cerealeAutre);

    $listHygienes = array();
    if (isset($this->hygienes) && is_array($this->hygienes) && count($this->hygienes) > 0)
    {
      foreach ($this->hygienes as $v) array_push($listHygienes, explode(';', $v)[1]);
    }
    if (isset($this->hygieneAutre) && strlen($this->hygieneAutre) > 0) array_push($listHygienes, $this->hygieneAutre);

    $listEntretiens = array();
    if (isset($this->entretiens) && is_array($this->entretiens) && count($this->entretiens) > 0)
    {
      foreach ($this->entretiens as $v) array_push($listEntretiens, explode(';', $v)[1]);
    }
    if (isset($this->entretienAutre) && strlen($this->entretienAutre) > 0) array_push($listEntretiens, $this->entretienAutre);

    $listAnimauxNourriture = array();
    if (isset($this->nourritureAnimaux) && is_array($this->nourritureAnimaux) && count($this->nourritureAnimaux) > 0)
    {
      foreach ($this->nourritureAnimaux as $v) array_push($listAnimauxNourriture, explode(';', $v)[1]);
    }
    if (isset($this->nourritureAnimauxAutre) && strlen($this->nourritureAnimauxAutre) > 0) array_push($listAnimauxNourriture, $this->nourritureAnimauxAutre);

    $listPoissons = array();
    if (isset($this->poissons) && is_array($this->poissons) && count($this->poissons) > 0)
    {
      foreach ($this->poissons as $v) array_push($listPoissons, explode(';', $v)[1]);
    }
    if (isset($this->poissonAutre) && strlen($this->poissonAutre) > 0) array_push($listPoissons, $this->poissonAutre);    

    $listautres = array();
    if (isset($this->autreProduitInconnu) && strlen($this->autreProduitInconnu) > 0) array_push($listautres, $this->autreProduitInconnu);

    $listingComplet = array();
    $listingComplet['legumes'] = $listLegumes;
    $listingComplet['viandes'] = $listViandes;
    $listingComplet['laitiers'] = $listLaitiers;
    $listingComplet['ruches'] = $listRuches;
    $listingComplet['fruits'] = $listFruits;
    $listingComplet['champignons'] = $listChampignons;
    $listingComplet['boissons'] = $listBoissons;
    $listingComplet['poissons'] = $listPoissons;
    $listingComplet['plantes'] = $listPlantes;
    $listingComplet['semences'] = $listSemences;
    $listingComplet['transformes'] = $listTransformes;
    $listingComplet['cereales'] = $listCereales;
    $listingComplet['hygienes'] = $listHygienes;
    $listingComplet['entretiens'] = $listEntretiens; 
    $listingComplet['nourritureanimaux'] = $listAnimauxNourriture;
    $listingComplet['autres'] = $listautres;

    return $listingComplet;
  }

}