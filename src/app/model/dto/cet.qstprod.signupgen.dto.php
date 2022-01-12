<?php
/** 
 * signupgen.form html form DTO.
 */
Class QstProdGeneraleDTO
{

  public $pk;
  private $lat;
  private $lng;
  private $produits;
  
  public $nom;
  public $prenom;
  public $email;
  public $motdepasseMD5;
  public $telfix;
  public $telport;
  public $nomferme;
  public $siret;
  public $adrNumvoie;
  public $adrRue;
  public $adrLieudit;
  public $adrCommune;
  public $adrCodePostal;
  public $adrComplementAdr;
  public $pageFB;
  public $pageIG;
  public $pageTwitter;
  public $siteWebUrl;
  public $boutiqueEnLigneUrl;
  public $organismeCertificateurBIO;
  public $niveauCertifAB;
  public $typeDeProduction;
  public $typeDeProductionAutre;
  public $surfaceHectTerres;
  public $surfaceHectSousSerre;
  public $nbrTetesBetail;
  public $hectolitresParAn;
  public $sondageDifficultes;
  public $sondage;
  public $groupeCagette;
  public $identifiant_cet;
  public $sondageNombrePostes;
  public $sondageNombreSaisonniers;
  public $sondageNombreHeuresSemaine;
  public $adrfermeLtrl;
  public $prodInscrit;
  public $produitsLtrl;
  public $marchesLtrl;
  public $lieuxLtrl;
  public $infosLtrl;
  public $urlMultiplesLtrl;
  public $fournisseurcet;
  public $categorie;

  function __construct(
    $pNom = "", $pPrenom = "", $pEmail = "", 
    $pMotDePasseMD5 = "", $pTelFix = "", 
    $pTelPort = "", $pNomFerme = "", $pSiret = "", 
    $pAdrNumvoie = "", $pAdrRue = "", $pAdrLieudit = "", 
    $pAdrCommune = "", $pAdrCodePostal = "", 
    $pAdrComplementAdr = "", $pPageFB = "", $pPageIG = "", 
    $pPageTwitter = "", $pPUrlWeb = "", $pUrlBoutiqueWww = "", 
    $pOrgCertifBIO = "", $pTypeProd = "", $pTypeProductionAutre = "",
    $pSurfaceHTerres = 0, $pSurfaceHSerre = 0, $pNbrTetesBetail = 0, 
    $pHectolitresParAn = 0, $pSondageDifficultes = "", $pSondage = "", 
    $pGroupeCagette = "", $pIdentifiant_cet= "", $pSondageNbrPostes = "", 
    $pSondageNbrSaisonniers = "", $pSondageNbrHeuresSemaine = "",
    $pNiveauCertifAB = "", $pCategorie = "")
  {
      $this->nom = $pNom;
      $this->prenom = $pPrenom;
      $this->email = $pEmail;
      $this->motdepasseMD5 = $pMotDePasseMD5;
      $this->telfix = $pTelFix;
      $this->telport = $pTelPort;
      $this->nomferme = $pNomFerme;
      $this->siret = $pSiret;
      $this->adrNumvoie = $pAdrNumvoie;
      $this->adrRue = $pAdrRue;
      $this->adrLieudit = $pAdrLieudit;
      $this->adrCommune = $pAdrCommune;
      $this->adrCodePostal = $pAdrCodePostal;
      $this->adrComplementAdr = $pAdrComplementAdr;
      $this->pageFB = $pPageFB;
      $this->pageIG = $pPageIG;
      $this->pageTwitter = $pPageTwitter;
      $this->siteWebUrl = $pPUrlWeb;
      $this->boutiqueEnLigneUrl = $pUrlBoutiqueWww;
      $this->organismeCertificateurBIO = $pOrgCertifBIO;
      $this->niveauCertifAB = $pNiveauCertifAB;
      $this->typeDeProduction = $pTypeProd;
      $this->typeDeProductionAutre = $pTypeProductionAutre;
      $this->surfaceHectTerres = $pSurfaceHTerres;
      $this->surfaceHectSousSerre = $pSurfaceHSerre;
      $this->nbrTetesBetail = $pNbrTetesBetail;
      $this->hectolitresParAn = $pHectolitresParAn;
      $this->sondageDifficultes = $pSondageDifficultes;
      $this->sondage = $pSondage;
      $this->groupeCagette = $pGroupeCagette;
      $this->identifiant_cet = $pIdentifiant_cet;
      $this->sondageNombrePostes = $pSondageNbrPostes;
      $this->sondageNombreSaisonniers = $pSondageNbrSaisonniers;
      $this->sondageNombreHeuresSemaine = $pSondageNbrHeuresSemaine;
      $this->categorie = $pCategorie;
  }

  /**
   * init this DTO in public mode for Front end purposes.
   */ 
  public function initFrontEndDTO(
    $pNom = "", $pPrenom = "", $pEmail = "", 
    $pTelFix = "", $pTelPort = "", $pNomFerme = "", 
    $pAdrNumvoie = "", $pAdrRue = "", $pAdrLieudit = "", 
    $pAdrCommune = "", $pAdrCodePostal = "", 
    $pAdrComplementAdr = "", $pPageFB = "", $pPageIG = "", 
    $pPageTwitter = "", $pPUrlWeb = "", $pUrlBoutiqueWww = "",
    $pGroupeCagette = "", $pIndentifiant_cet = "", 
    $pAdrfermeLtrl = "", $pProdInscrit = "", $pProduitsLtrl = "", 
    $pMarchesLtrl = "", $pLieuxLtrl = "", $pInfosLtrl = "", $pUrlMultiplesLtrl = "",
    $pFournisseurCET = "", $pCategorie = "")
  {
      $this->nom = $pNom;
      $this->prenom = $pPrenom;
      $this->email = $pEmail;
      $this->telfix = $pTelFix;
      $this->telport = $pTelPort;
      $this->nomferme = $pNomFerme;
      $this->adrNumvoie = $pAdrNumvoie;
      $this->adrRue = $pAdrRue;
      $this->adrLieudit = $pAdrLieudit;
      $this->adrCommune = $pAdrCommune;
      $this->adrCodePostal = $pAdrCodePostal;
      $this->adrComplementAdr = $pAdrComplementAdr;
      $this->pageFB = $pPageFB;
      $this->pageIG = $pPageIG;
      $this->pageTwitter = $pPageTwitter;
      $this->siteWebUrl = $pPUrlWeb;
      $this->boutiqueEnLigneUrl = $pUrlBoutiqueWww;
      $this->groupeCagette = $pGroupeCagette;
      $this->identifiant_cet = $pIndentifiant_cet;
      $this->adrfermeLtrl = $pAdrfermeLtrl;
      $this->prodInscrit = $pProdInscrit;
      $this->produitsLtrl = $pProduitsLtrl;
      $this->marchesLtrl = $pMarchesLtrl;
      $this->lieuxLtrl = $pLieuxLtrl;
      $this->infosLtrl = $pInfosLtrl;
      $this->urlMultiplesLtrl = $pUrlMultiplesLtrl;
      $this->fournisseurcet = $pFournisseurCET;
      $this->categorie = $pCategorie;
  }

  public function setTypeDeProduction($types) {
    $this->typeDeProduction = $types;
  }

  public function setTypeDeProductionAutre($typeAutre) {
    $this->typeDeProductionAutre = $typeAutre;
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

  public function setProduits($prds) 
  {
    $this->produits = $prds;
  }

  public function getProduits()
  {
    return $this->produits;
  }

}