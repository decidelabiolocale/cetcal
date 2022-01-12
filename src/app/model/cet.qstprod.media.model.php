<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODMediaModel extends CETCALModel 
{

  /**
    +---------------+---------------+------+-----+---------+----------------+
    | Field         | Type          | Null | Key | Default | Extra          |
    +---------------+---------------+------+-----+---------+----------------+
    | id            | int(11)       | NO   | PRI | NULL    | auto_increment |
    | libelle       | varchar(512)  | YES  |     | NULL    |                |
    | type          | varchar(8)    | NO   |     | NULL    |                |
    | ext           | varchar(8)    | NO   |     | NULL    |                |
    | urlr          | varchar(1024) | NO   |     | NULL    |                |
    | cible         | varchar(32)   | NO   |     | NULL    |                |
    | fk_producteur | int(11)       | YES  |     | NULL    |                |
    | fk_entite     | int(11)       | YES  |     | NULL    |                |
    +---------------+---------------+------+-----+---------+----------------+
  */
  public function insertMediaProducteur($libelle, $type, $ext, $urlr, $cible, $fk_producteur) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MEDIA_PRODUCTEUR);
      $stmt->bindParam(":pLibelle", $libelle, PDO::PARAM_STR);
      $stmt->bindParam(":pType", $type, PDO::PARAM_STR);
      $stmt->bindParam(":pExt", $ext, PDO::PARAM_STR);
      $stmt->bindParam(":pUrlr", $urlr, PDO::PARAM_STR);
      $stmt->bindParam(":pCible", $cible, PDO::PARAM_STR);
      $stmt->bindParam(":pFk", $fk_producteur, PDO::PARAM_INT);
      $stmt->execute();    
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function insertMediaEntite($libelle, $type, $ext, $urlr, $cible, $fk_entite) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MEDIA_ENTITE);
      $stmt->bindParam(":pLibelle", $libelle, PDO::PARAM_STR);
      $stmt->bindParam(":pType", $type, PDO::PARAM_STR);
      $stmt->bindParam(":pExt", $ext, PDO::PARAM_STR);
      $stmt->bindParam(":pUrlr", $urlr, PDO::PARAM_STR);
      $stmt->bindParam(":pCible", $cible, PDO::PARAM_STR);
      $stmt->bindParam(":pFk", $fk_entite, PDO::PARAM_INT);
      $stmt->execute();    
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function select($fk) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_MEDIA_PRODUCTEUR);
      $stmt->bindParam(":pFk", $fk, PDO::PARAM_INT);
      $stmt->execute();    
      $data = $stmt->fetchAll();

      return $data;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function selectMediasEntite($fk) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_MEDIA_ENTITE);
      $stmt->bindParam(":pFk", $fk, PDO::PARAM_INT);
      $stmt->execute();    
      $data = $stmt->fetchAll();

      return $data;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function selectSrcLogoEntite($fk) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_MEDIA_ENTITE_LOGO);
      $stmt->bindParam(":pFk", $fk, PDO::PARAM_INT);
      $stmt->execute();    
      $data = $stmt->fetch();
      return $data ? $data['urlr'] : '';
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function selectSrcLogoFerme($fk) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_MEDIA_PRODUCTEUR_LOGO_FERME);
      $stmt->bindParam(":pFk", $fk, PDO::PARAM_INT);
      $stmt->execute();    
      $data = $stmt->fetch();
      return $data ? $data['urlr'] : '';
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function deleteMediaProductuer($id, $fk_producteur) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::DELETE_PHYSIQUE_MEDIA_PRODUCTEUR);
      $stmt->bindParam(":pPk", $id, PDO::PARAM_INT);
      $stmt->bindParam(":pFk_producteur", $fk_producteur, PDO::PARAM_INT);
      $stmt->execute();    
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  public function deleteMediaEntite($id, $fk_entite) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::DELETE_PHYSIQUE_MEDIA_ENTITE);
      $stmt->bindParam(":pPk", $id, PDO::PARAM_INT);
      $stmt->bindParam(":pFk_entite", $fk_entite, PDO::PARAM_INT);
      $stmt->execute();    
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }
  
}