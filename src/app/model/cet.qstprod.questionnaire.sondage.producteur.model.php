<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODSondageProducteurModel extends CETCALModel 
{
  
  public function gestionEnvoiQstprod($pPK, $pInfoGeneralesDto, $contextMdifGlobal, $pk_mdif)
  {
    $this->createSondages($contextMdifGlobal ? $pk_mdif : $pPK, $pInfoGeneralesDto);
  }

  /**
   * Utilise this fetchSondage.
   * Pour chaque entrée, reconstruire la valeur nécessaire au formalaire signupgen.form.php
   */
  public function fetchSondageKVAsString($pk)
  {
    $data = $this->fetchSondage($pk);
    $res = array();
    foreach ($data as $kv) array_push($res, $kv['clef_question'].';'.$kv['reponse']);

    return $res;
  }

  /**
   * La param $data = array retourné par this fetchSondage.
   * Si une clé réponse est présente dans l'array clé/valeure à l'index i alors
   * la valeur (index clé/valeur 1) est retounée. 
   */ 
  public function getReponseParClef($data, $clef)
  {
    foreach ($data as $values) 
    {
      $kv = explode(';', $values);
      if (strcmp($kv[0], $clef) === 0) return ''.$kv[1];
    }
    return '';
  }

  /**
   * Retourne un array des entrées cetcal_sondage pour une
   * Clé étrangère (primaire producteur) de producteur.
   */
  public function fetchSondage($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_PRODUCTEUR_SONDAGE_BY_PK);
    $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  /* *************************************************************************************************
   * fonctions privées.
   */
  
  private function createSondages($pPK, $pInfoGeneralesDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    $dtoinfos = new QstProdGeneraleDTO();
    $dtoinfos = unserialize($pInfoGeneralesDto);
    
    foreach ($dtoinfos->sondageDifficultes as $difficulte) 
    {
      $qrsondage = explode(";", $difficulte);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $qrsondage[0], PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $qrsondage[1], PDO::PARAM_STR);
      $stmt->execute();
    }

    foreach ($dtoinfos->sondage as $reponse) 
    {
      $qrsondage = explode(";", $reponse);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $qrsondage[0], PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $qrsondage[1], PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoinfos->sondageNombrePostes)) 
    {
      $clefQuestion = "snbp";
      $valQuestion = "Nombre de postes";
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE_NBRS);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $clefQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pValQuestion", $valQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $dtoinfos->sondageNombrePostes, PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoinfos->sondageNombreSaisonniers)) 
    {
      $clefQuestion = "snbs";
      $valQuestion = "Nombre de saisonniers";
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE_NBRS);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $clefQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pValQuestion", $valQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $dtoinfos->sondageNombreSaisonniers, PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoinfos->sondageNombreHeuresSemaine)) 
    {
      $clefQuestion = "snhs";
      $valQuestion = "Nombre d'heures semaine";
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE_NBRS);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $clefQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pValQuestion", $valQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $dtoinfos->sondageNombreHeuresSemaine, PDO::PARAM_STR);
      $stmt->execute();
    }
  }

}