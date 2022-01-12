<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODLieuModel extends CETCALModel
{

  /**
   * Gestion de l'écriture en base lors de l'inscription ou des ré-écriture / updates en contexte de modification.
   */
  public function gestionEnvoiQstprod($pPK, $pLieuDto, $contextMdifGlobal, $pk_mdif)
  {
    $this->createLieu($contextMdifGlobal ? $pk_mdif : $pPK, $pLieuDto, $contextMdifGlobal);
  }

  public function getSousTypesSiNonNULL($type)
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_SOUS_TYPE_LIEU_BY_TYPE);
      $stmt->bindParam(":pType", $type, PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $data;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  /**
   * fonctions publiques
   */
  public function allLieuDistDistinctType()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_DISTINCT_ALL_TYPE_LIEU);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  /**
   * Permet de récupérer tout les sous types d'un type
   * @param string $type
   * @return array
   */
  public function findOneTypeLieu($type)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ONE_TYPE_LIEU);
    $stmt->bindParam(":pType", $type, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getDenominatonsByTypes($types)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare(str_replace('[types]', $types, $qLib::SELECT_ALL_ENTITE_BY_TYPES));
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $data;
  }

  public function getAllMarcheDenomination()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_DENOMINATION_MARCHE);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }


  public function getAllAmapDenomination()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_DENOMINATION_AMAP);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function selectAllByPkProducteur($pk)
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_LIEUX_BY_PK_PRODUCTEUR);
      $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
      $stmt->execute();    
      $data = $stmt->fetchAll();

      return $data;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

    public function selectAllLieuxDistByPkProducteur($pk)
    {
        try
        {
            $qLib = $this->getQuerylib();
            $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_LIEUX_DIST_PROD_BY_PK );
            $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $data;
        }
        catch (Exception $e)
        {
            error_log($e->getMessage());
        }
    }

  /* *************************************************************************************************
   * fonctions privées.
   */

  private function createLieu($pPK, $pLieuDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
    $dtoLieux = new QstLieuxDistributionDTO();
    $dtoLieux = unserialize($pLieuDto);
    $obj = json_decode($dtoLieux->json);

    foreach ($obj->lieux as $lieu)
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_PRODUCTEUR_LIEU_DE_DISTRIBUTION);
      $stmt->bindParam(":pFk_producteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pFk_entite", $lieu->pk_entite, PDO::PARAM_STR);
      $stmt->bindParam(":pCodeType", $lieu->code_type, PDO::PARAM_STR);
      $stmt->bindParam(":pType", $lieu->type, PDO::PARAM_STR);
      $stmt->bindParam(":pCodeSousType", $lieu->code_sous_type, PDO::PARAM_STR);
      $stmt->bindParam(":pSousType", $lieu->sous_type, PDO::PARAM_STR);
      $stmt->bindParam(":pDenomination", $lieu->denomination, PDO::PARAM_STR);
      $stmt->bindParam(":pCreaMarche", $lieu->crea_marche, PDO::PARAM_STR);
      $stmt->bindParam(":pPrecisions", $lieu->precs, PDO::PARAM_STR);
      $stmt->bindParam(":pDateLieu", $lieu->date, PDO::PARAM_STR);
      $stmt->bindParam(":pHeureDeb", $lieu->heure_deb, PDO::PARAM_STR);
      $stmt->bindParam(":pHeureFin", $lieu->heure_fin, PDO::PARAM_STR);
      $stmt->bindParam(":pJour", $lieu->jour, PDO::PARAM_STR);
      $stmt->execute();
    }
  }

}