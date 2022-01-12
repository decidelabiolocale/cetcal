<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALAdminModel extends CETCALModel 
{
  
  public function get($mpd, $login) 
  {
    $qLib = $this->getQuerylib();
  }

  public function getAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_AMINISTRATION);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function exists($mdp, $email, $usrName)
  {
    $result = false;
    $mdp_hash = hash("sha512", $mdp);

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_AMINISTRATION_EMAIL_OR_LOGIN);
    $stmt->bindParam(":pAdmEmail", $email, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmUsrName", $usrName, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmUsrMdp", $mdp_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['adm_email']) && strcmp($row['adm_usr_mdp'], $mdp_hash) === 0) 
      {
        $result = true;
      }
      else if (isset($row['adm_usr_name']) && strcmp($row['adm_usr_mdp'], $mdp_hash) === 0) 
      {
        $result = true;
      }
    }

    return $result;
  }

  public function getAdministrateur($mdp, $email, $usrName)
  {
    $mdp_hash = hash("sha512", $mdp);

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_AMINISTRATION_EMAIL_OR_LOGIN);
    $stmt->bindParam(":pAdmEmail", $email, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmUsrName", $usrName, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmUsrMdp", $mdp_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['adm_email']) && strcmp($row['adm_usr_mdp'], $mdp_hash) === 0) 
      {
        return $row;
      }
      else if (isset($row['adm_usr_name']) && strcmp($row['adm_usr_mdp'], $mdp_hash) === 0) 
      {
        return $row;
      }
    }

    return false;
  }

  public function getAdministrateurBySessionId($sessionId)
  {
    $session_hash = hash("sha512", $sessionId);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_ADMIN_BY_SESSION_ID);
    $stmt->bindParam(":pSessionId", $session_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch();

    return $data;
  }

  public function setTempSessionId($sessionId, $login)
  {
    $session_hash = hash("sha512", $sessionId);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_AMINISTRATION_SESSION);
    $stmt->bindParam(":pSessionId", $session_hash, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmLoginEmail", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmLogin", $login, PDO::PARAM_STR);
    $stmt->execute();
  }

  public function authTempSessionId($sessionId)
  {
    $session_hash = hash("sha512", $sessionId);
    error_log("[AUTH ADMIN] sitkn= ".$session_hash);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_AMINISTRATION_SESSION);
    $stmt->bindParam(":pSessionId", $session_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC); 

    if (isset($data['session_id']) && 
        strcmp($data['session_id'], $session_hash) === 0) return 1;
    return -1;
  }

  public function updateHabilitations($pk, $hab_producteurs, $hab_certif_bioab, $hab_entites, $hab_geoloc, $hab_admins, $hab_histo)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_HABILITATIONS_ADMIN_BY_PK);
    $stmt->bindParam(":pHab_producteurs", $hab_producteurs, PDO::PARAM_STR);
    $stmt->bindParam(":pHab_certif_bioab", $hab_certif_bioab, PDO::PARAM_STR);
    $stmt->bindParam(":pHab_entites", $hab_entites, PDO::PARAM_STR);
    $stmt->bindParam(":pHab_geoloc", $hab_geoloc, PDO::PARAM_STR);
    $stmt->bindParam(":pHab_admins", $hab_admins, PDO::PARAM_STR);
    $stmt->bindParam(":pHab_histo", $hab_histo, PDO::PARAM_STR);
    $stmt->bindParam(":pPkAdm", $pk, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function desactiverAdminByPk($pk)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::DESACTIVATE_ADMIN_BY_PK);
    $stmt->bindParam(":pPkAdm", $pk, PDO::PARAM_INT);
    $stmt->execute();
  }

}