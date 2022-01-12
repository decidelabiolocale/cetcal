<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class BioDataModel extends CETCALModel 
{

  public function certifierProducteur($pk_producteur, $url, $num_certif)
  {
    try
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::DELETE_FROM_BIODATA_WHERE_PKPRD);
      $stmt->bindParam(":pPk_producteur", $pk_producteur, PDO::PARAM_INT);
      $stmt->execute();

      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_INTO_CETCAL_BIODATA);
      $stmt->bindParam(":pPk_producteur", $pk_producteur, PDO::PARAM_INT);
      $stmt->bindParam(":pUrl", $url, PDO::PARAM_STR);
      $stmt->bindParam(":pNumCertif", $num_certif, PDO::PARAM_STR);
      $stmt->execute();

      return true;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
      return false;
    }
  }

  public function decertifierProducteur($pk_producteur)
  {
    try
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::DELETE_FROM_BIODATA_WHERE_PKPRD);
      $stmt->bindParam(":pPk_producteur", $pk_producteur, PDO::PARAM_INT);
      $stmt->execute();

      return true;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
      return false;
    }
  }

  public function getCertificationProducteur($pk_producteur)
  {
    try
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_BIODATA_BY_FK_PRODUCTEUR);
      $stmt->bindParam(":pPk_producteur", $pk_producteur, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetch();

      return $data;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function findCertificationAB($nom, $prenom, $nomFerme)
  {
    try
    {
      $u_nom = mb_strtoupper($nom, 'UTF-8');
      $u_prenom = mb_strtoupper($prenom, 'UTF-8');
      $nom_commercial = mb_strtoupper($nomFerme, 'UTF-8');

      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_BIODATA_BY_NOM_PRENOM_RS_LIMIT_1);
      //$stmt->bindParam(":pNom", $u_nom, PDO::PARAM_STR);
      //$stmt->bindParam(":pPrenom", $u_prenom, PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll();

      foreach ($data as $biodata) 
      {
        $tmp = explode(' ', $biodata['denomination']);
        if (strcmp(mb_strtoupper($tmp[0], 'UTF-8'), $u_nom) === 0 && 
            strcmp(mb_strtoupper($tmp[1], 'UTF-8'), $u_prenom) === 0) return $biodata;
      }

      return false;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  } 

}