<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALUserModel extends CETCALModel 
{

	public function insert($pEmail, $pUsrNom, $pTypeUser, $pMdpHash, $pTelPort, $pCommune, $pIP,
    $pInfos, $pAchat, $pHebdo) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.identifiantcet.php');
    $idHelper = new IdentifiantCETHelper();
    $cetcal_web_id = hash('sha256', 
      $idHelper->generateRandomString().$pMdpHash.$pEmail.$idHelper->generateRandomString());

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_USER);
    $stmt->bindParam(":pEmail", $pEmail, PDO::PARAM_STR);
    $stmt->bindParam(":pUsrNom", $pUsrNom, PDO::PARAM_STR);
    $stmt->bindParam(":pUsrType", $pTypeUser, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpHash", $pMdpHash, PDO::PARAM_STR);
    $stmt->bindParam(":pTelPort", $pTelPort, PDO::PARAM_STR);
    $stmt->bindParam(":pCommune", $pCommune, PDO::PARAM_STR);
    $stmt->bindParam(":pIP", $pIP, PDO::PARAM_STR);
    $stmt->bindParam(":pCetWebID", $cetcal_web_id, PDO::PARAM_STR);
    $stmt->bindParam(":pInfos", $pInfos, PDO::PARAM_INT);
    $stmt->bindParam(":pAchat", $pAchat, PDO::PARAM_INT);
    $stmt->bindParam(":pHebdo", $pHebdo, PDO::PARAM_INT);
    $stmt->execute();
    $pk = $this->getCnxdb()->lastInsertId();

    return array("pk" => $pk, "wid" => $cetcal_web_id);
  }

  public function setTempSessionId($sessionId, $ip, $pk)
  {    
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_USER_SESSION);
    $stmt->bindParam(":pSessionId", $sessionId, PDO::PARAM_STR);
    $stmt->bindParam(":pUserIp", $ip, PDO::PARAM_STR);
    $stmt->bindParam(":pUserId", $pk, PDO::PARAM_INT);

    $stmt->execute();
  }

  public function updateMdpByEmail($email, $mdp_tmp)
  {
    $pwd_hash = hash('sha256', $mdp_tmp);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_USER_MOT_DE_PASSE);
    $stmt->bindParam(":pEmail", $email, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpsha", $pwd_hash, PDO::PARAM_STR);

    $stmt->execute();
  }

  public function selectAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_USER);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function fetchUserByEmail($email)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_USER_BY_EMAIL);
      $stmt->bindParam(":pEmail", $email, PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll();

      return $data;
  }

  public function fetchPKByEmailAndPWD($email, $mdp)
  {
    $pwd_hash = hash('sha256', $mdp);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_USER_BY_EMAIL_AND_PWD_HASH);
    $stmt->bindParam(":pEmail", $email, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpHash", $pwd_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch();

    return $data['user_id'];
  }

  public function existsByEmail($email)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ONE_USER_BY_EMAIL);
    $stmt->bindParam(":pEmail",  $email, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch();

    return (isset($data['user_id']) && !empty($data['user_id'])) ? true : false;
  }

}