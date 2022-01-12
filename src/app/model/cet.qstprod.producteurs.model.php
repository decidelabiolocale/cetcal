<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODProducteurModel extends CETCALModel 
{
  
  public function gestionEnvoiQstprod($pProducteurDto, $pProduitsDto, $pConsoDto, $pOpinionsProducteurs, $contextMdifGlobal, $pk_mdif)
  {
    if ($contextMdifGlobal === false) 
    {
      return $this->createProducteur($pProducteurDto, $pProduitsDto, $pConsoDto, $pOpinionsProducteurs);
    }
    else if ($contextMdifGlobal === true) 
    {
      return $this->createProducteur($pProducteurDto, $pProduitsDto, $pConsoDto, $pOpinionsProducteurs,
        true, $pk_mdif);
    }
  }

  public function fetchPKByEmailORIDwwwCETAndPWD($login, $mdp)
  {
    $pwd_hash = hash('sha256', $mdp);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PK_CETCAL_PRODUCTEUR_BY_EMAIL_AND_PWD_HASH);
    $stmt->bindParam(":pEmail", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pIdwwwcet", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpHash", $pwd_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch();

    return $data['pk_producteur'];
  }

  public function exists($pProducteurDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    $dtoGenerale = new QstProdGeneraleDTO();
    $dtoGenerale = unserialize($pProducteurDto);

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_SIRET_PRODUCTEUR_PAR_SIRET);
    $stmt->execute(['pSiret' => $dtoGenerale->siret]);
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['siret']) && strcmp($row['siret'], $dtoGenerale->siret) === 0) return true;
    }
    return false;
  }

  public function emailExists($email)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_EMAIL_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      if (isset($row['email']) && strcmp($row['email'], $email) === 0) return 1;
    }
    return 0;
  }

  public function emailExistsSurAutrePk($email, $pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_EMAIL_AND_PK_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      if (isset($row['email']) && strcmp($row['email'], $email) === 0 && 
          strcmp($row['pk_producteur'], $pk) !== 0) 
      {
        return 1;
      }
    }

    return 0;
  }

  private function identifiantExists($pIdCet)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_ID_CET_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['identifiant_cet']) && strcmp($row['identifiant_cet'], $pIdCet) === 0) return true;
    }
    return false;
  }

  public function fetchAllDataToDTOArray()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    $dataCarto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'], 
        $row['telfixe'], $row['telport'], $row['nom_ferme'], 
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'], 
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'], 
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'], 
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette']);
      $dtoGenerale->setPk($row['pk_producteur']);
      array_push($dataCarto, $dtoGenerale);
    }

    return $dataCarto;
  }

  public function fetchProducteurInscritByEmailOrIdWWWCET($login)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_PRODUCTEUR_INSCRIT_BY_EMAIL_OR_IDWWWCET);
    $stmt->bindParam(":pEmail", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pIdwwwcet", $login, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function fetchProducteurByEmailOrIdWWWCET($login)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_PRODUCTEUR_BY_EMAIL_OR_IDWWWCET);
    $stmt->bindParam(":pEmail", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pIdwwwcet", $login, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function findProducteurByPk($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_PRODUCTEUR_BY_PK);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch();

    return $data;
  }

  public function findProducteursINPkArray($pks)
  {
    $qLib = $this->getLookupsLib();
    $inQuery = implode(',', $pks);
    $stmt = $this->getCnxdb()->prepare(str_replace('[pks]', $inQuery, $qLib::SELECT_CETCAL_PRODUCTEUR_IN_PKS));
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function findLieuByProducteurByPk($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PRODUCTEUR_LIEU_JOIN);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function findProduitByPkProducteur($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PRODUIT_BY_PK_PRODUCTEUR);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function pksProducteursParNomProduit($nom_produit, $use_wildcards)
  {
    $qLib = $this->getLookupsLib();
    $stmt = $this->getCnxdb()->prepare($use_wildcards ? 
      $qLib::SELECT_PKS_PRODUCTEUR_BY_NOM_PRODUIT_WILCARDS : 
      $qLib::SELECT_PKS_PRODUCTEUR_BY_NOM_PRODUIT);
    $stmt->bindParam(":pNomProduit", $nom_produit, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    $tmp = array();
    foreach ($data as $pk) array_push($tmp, $pk['pk_producteur']); 
    return $tmp;
  }

  public function findProduitByFkProducteur($fk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PRODUIT_BY_FK_PRODUCTEUR);
    $stmt->bindParam(":pFk_producteur", $fk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function findCategoriesProduitsByPkProducteur($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CATEGORIES_PRODUITS_BY_PK_PRODUCTEUR);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function findInfosConsomateursByPkProducteur($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_MODE_CONSO_BY_PK_PRODUCTEUR);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function findBesoinsByPkProducteur($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_BESOINS_INFORMATIONS_BY_PK_PRODUCTEUR);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function findAutreProduitInconnuByPk($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_AUTRE_PRODUIT_INCONNU_BY_PK_PRODUCTEUR);
    $stmt->bindParam(":pFk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function getOpinionsInscription($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_OPINIONS_ANNUAIRE_PRODUCTEUR_BY_PK);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch();

    return $data['opinions'];
  }
  
  /**
   * Select all des producteurs inscrits via questionnaire producteur CETCAL.
   */
  public function fetchAllFrontEndDTOArray()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet'], $row['categorie']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;
  }

  /**
   * Select all des producteurs pré-inscrits via traitement batch sur fichier CSV de Céline.
   */
  public function fetchAllFrontEndDTOArrayPreInscrits()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR_N0N_INSCRIT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet'], $row['categorie']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;
  }

  public function fetchAllListing() 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR_INSCRIT_N0N_INSCRIT_ASC);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet'], $row['categorie']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;   
  }

  /**
   * Select des N derniers producteur inscrits (order by desc LIMIT = $limit).
   */
  public function fetchProducteursDerniersInscrit($limit)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR_INSCRITS_LIMIT_N);
    $stmt->bindParam(":pLimit", $limit, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet'], $row['categorie']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;
  }

  public function getTypesProductionCleValAsString($pk) {
    $types = '';
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_TYPE_PRODUCTION_AND_AUTRE);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $types.= $row['clef_type_production'].';'.$row['val_type_production'].'µ';
    }

    return $types;
  }

  public function getTypesProduction($pk) {
    $types = '';
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_TYPE_PRODUCTION);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $types.= $row['val_type_production'].'µ';
    }

    return $types;
  }

  public function findSpecificitesProduitsByPkProducteur($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_SPECIFICITES_PRODUCTION_BY_PK_PRODUCTEUR);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function setTempSessionId($sessionId, $ip, $pk)
  {    
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_PRODUCTEUR_SESSION);
    $stmt->bindParam(":pSessionId", $sessionId, PDO::PARAM_STR);
    $stmt->bindParam(":pProducteurIp", $ip, PDO::PARAM_STR);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function updateMdpByEmail($email, $mdp_tmp)
  {
    $pwd_hash = hash('sha256', $mdp_tmp);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_PRODUCTEUR_MOT_DE_PASSE);
    $stmt->bindParam(":pEmail", $email, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpsha", $pwd_hash, PDO::PARAM_STR);
    $stmt->execute();
  }

  public function desactiverProducteurByPk($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::DESACTIVER_PRODUCTEUR_BY_PK);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function activerProducteurByPk($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::ACTIVER_PRODUCTEUR_BY_PK);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function updateStatutInscrit($pk, $prod_inscrit, $prod_active, $id_cal)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_PRODUCTEUR_ETAT_INSCRIT);
    $stmt->bindParam(":pPrdInscrit", $prod_inscrit, PDO::PARAM_STR);
    $stmt->bindParam(":pPrdActive", $prod_active, PDO::PARAM_INT);
    $stmt->bindParam(":pIdCetcal", $id_cal, PDO::PARAM_STR);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function updateMdp($pk, $sitkn, $usridf, $ancien_mdp, $nouveau_mdp)
  {
    $ancien_mdp_hash = hash('sha256', $ancien_mdp);
    $nouveau_mdp_hash = hash('sha256', $nouveau_mdp);

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_CRITIQUE_PRODUCTEUR_MDPSHA);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->bindParam(":pSessionId", $sitkn, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpsha", $ancien_mdp_hash, PDO::PARAM_STR);
    $stmt->bindParam(":pNMdpsha", $nouveau_mdp_hash, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->rowCount();
  }

  public function findLieuxDistByPk($pk)
  {
    require_once('cet.qstprod.lieuxdist.model.php');
    $model_lieux = new QSTPRODLieuModel();
    $lieux = $model_lieux->selectAllByPkProducteur($pk);

    return $lieux;
  }

  /* *************************************************************************************************
   * fonctions privées.
   */

  private function createProducteur($pProducteurDto, $pProduitsDto, $pConsoDto, $pOpinionsProducteurs, $update_producteur = false, $pk_mdif = -1) 
  {
    error_log('[QSTPRODProducteurModel] create producteur en contexte modif='.($update_producteur ? 'true' : 'false').' pk='.$pk_mdif);

    /**
     * Générer un identifiant de connexion et cela dans tous les 
     * cas (email, n° tel fixe ou mobile renseingés).
     */
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.identifiantcet.php');
    $idHelper = new IdentifiantCETHelper();
    $cetcal_web_id = $idHelper->generateRandomString();
    while ($this->identifiantExists($cetcal_web_id)) $cetcal_web_id = $idHelper->generateRandomString(12);

    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupprods.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupconso.dto.php');
    $nullClef= '0000';
    $prodInscrit = 'true';
    $dtoGenerale = new QstProdGeneraleDTO();
    $dtoGenerale = unserialize($pProducteurDto);
    $dtoProduits = new QstProduitDTO();
    $dtoProduits = unserialize($pProduitsDto);
    $dtoConsomation = new QstConsomateursDTO();
    $dtoConsomation = unserialize($pConsoDto);

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($update_producteur ? 
      $qLib::UPDATE_QSTPROD_PRODUCTEUR : $qLib::INSERT_QSTPROD_PRODUCTEUR);
    $stmt->bindParam(":pNom", $dtoGenerale->nom, PDO::PARAM_STR);
    $stmt->bindParam(":pPrenom", $dtoGenerale->prenom, PDO::PARAM_STR);
    $stmt->bindParam(":pEmail", $dtoGenerale->email, PDO::PARAM_STR);
    $stmt->bindParam(":pEmailBu", $dtoGenerale->email, PDO::PARAM_STR);
    if ($update_producteur === false) $stmt->bindParam(":pMdpsha", $dtoGenerale->motdepasseMD5, PDO::PARAM_STR);
    $stmt->bindParam(":pTelfixe", $dtoGenerale->telfix, PDO::PARAM_STR);
    $stmt->bindParam(":pTelPort", $dtoGenerale->telport, PDO::PARAM_STR);
    $stmt->bindParam(":pNomFerme", $dtoGenerale->nomferme, PDO::PARAM_STR);
    $stmt->bindParam(":pSiret", $dtoGenerale->siret, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrNumvoie", $dtoGenerale->adrNumvoie, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrRue", $dtoGenerale->adrRue, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrLieudit", $dtoGenerale->adrLieudit, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrCommune", $dtoGenerale->adrCommune, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrcp", $dtoGenerale->adrCodePostal, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrCmpladr", $dtoGenerale->adrComplementAdr, PDO::PARAM_STR);
    $stmt->bindParam(":pPageFb", $dtoGenerale->pageFB, PDO::PARAM_STR);
    $stmt->bindParam(":pPageIg", $dtoGenerale->pageIG, PDO::PARAM_STR);
    $stmt->bindParam(":pPageTwitter", $dtoGenerale->pageTwitter, PDO::PARAM_STR);
    $stmt->bindParam(":pUrlWeb", $dtoGenerale->siteWebUrl, PDO::PARAM_STR);
    $stmt->bindParam(":pUrlBoutique", $dtoGenerale->boutiqueEnLigneUrl, PDO::PARAM_STR);
    $stmt->bindParam(":pOrgCertifBio", $dtoGenerale->organismeCertificateurBIO, PDO::PARAM_STR);
    $stmt->bindParam(":pSurfaceHectTerres", $dtoGenerale->surfaceHectTerres, PDO::PARAM_STR);
    $stmt->bindParam(":pSurfaceAresSerre", $dtoGenerale->surfaceHectSousSerre, PDO::PARAM_STR);
    $stmt->bindParam(":pNbrTetes", $dtoGenerale->nbrTetesBetail, PDO::PARAM_STR);
    $stmt->bindParam(":pHLParAn", $dtoGenerale->hectolitresParAn, PDO::PARAM_STR);
    $stmt->bindParam(":pGroupeCagette", $dtoGenerale->groupeCagette, PDO::PARAM_STR);
    $stmt->bindParam(":pIndentifiantCet", $cetcal_web_id, PDO::PARAM_STR);
    $stmt->bindParam(":pOpinions", $pOpinionsProducteurs, PDO::PARAM_STR);
    $stmt->bindParam(":pNiveauCertifAB", $dtoGenerale->niveauCertifAB, PDO::PARAM_STR);
    if ($update_producteur === false) $stmt->bindParam(":pProdInscrit", $prodInscrit, PDO::PARAM_STR);
    if ($update_producteur) $stmt->bindParam(":pPk_producteur", $pk_mdif, PDO::PARAM_INT);
    $stmt->execute();

    $pk = $update_producteur ? $pk_mdif : $this->getCnxdb()->lastInsertId();
    if ($update_producteur) $this->deletePhysiqueInfosJointes($pk);

    if (isset($dtoGenerale->typeDeProductionAutre) && strlen($dtoGenerale->typeDeProductionAutre) > 0) array_push($dtoGenerale->typeDeProduction, "0001;".$dtoGenerale->typeDeProductionAutre);
    foreach ($dtoGenerale->typeDeProduction as $type) 
    {
      $typeprod = explode(';', $type);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_TYPEPRODUCTION);
      $stmt->bindParam(":pClef", $typeprod[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $typeprod[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    foreach ($dtoProduits->specificite as $spec)
    {
      $speci = explode(';', $spec);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_SPECIFICITE_PRODUITS);
      $stmt->bindParam(":pClef", $speci[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $speci[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoProduits->specificiteAutre) > 0) 
    {
      $nullClef = "0002";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_SPECIFICITE_PRODUITS);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoProduits->specificiteAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    foreach ($dtoConsomation->consoachats as $achat) 
    {
      $cachat = explode(';', $achat);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $cachat[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $cachat[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoConsomation->consoachatsAutre) > 0) 
    {
      $nullClef = "c001";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoConsomation->consoachatsAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    
    foreach ($dtoConsomation->paiments as $paiment) 
    {
      $cpaie = explode(';', $paiment);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $cpaie[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $cpaie[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoConsomation->paimentAutre) > 0) 
    {
      $nullClef = "c003";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoConsomation->paimentAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    foreach ($dtoConsomation->receptions as $recep)
    {
      $crecep = explode(';', $recep);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $crecep[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $crecep[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoConsomation->receptionAutre) > 0) 
    {
      $nullClef = "c002";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoConsomation->receptionAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    error_log('[QSTPRODProducteurModel] FIN create producteur en contexte modif='.($update_producteur ? 'true' : 'false').' pk='.$pk);
    return array("pk" => $pk, "ev" => $dtoGenerale->email, "idcetwww" => $cetcal_web_id);
  }

  private function deletePhysiqueInfosJointes($pk)
  {
    $tLib = $this->getTransacLib();
    try 
    {
      error_log("[QSTPRODProducteurModel] >>> START <<< TRANSAC pour producteur=".$pk);
      $transac = $tLib->build($tLib::DELETE_PHYSIQUE_DONNEES_PRODUCTEUR_BY_PK, $pk);
      foreach ($transac as $sqlline) $this->getCnxdb()->exec($sqlline);
      error_log("[QSTPRODProducteurModel] >>> END <<< TRANSAC pour producteur=".$pk);
    } 
    catch (Exception $e) 
    {
      error_log("[QSTPRODProducteurModel] >>> ERR ROLLBACK <<< TRANSAC pour producteur=".$pk);
      $this->getCnxdb()->exec($tLib::ROLLBACK);
      error_log("[QSTPRODProducteurModel] >>> ROLLBACK DONE <<< TRANSAC pour producteur=".$pk);
      error_log($e->getMessage());
    }
  }

}