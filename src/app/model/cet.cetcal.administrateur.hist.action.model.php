<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALAdminHistoriqueActionModel extends CETCALModel 
{

  public function getAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_HISTO_AMINISTRATION_ACTION);
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
  }

  public function insert($adm_fk, $adm_email, $adm_action_code, $adm_act_libfonc, $pk_element, $type_element, $denomination_element, $commentaire)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
    $futils = new FormatUtils();
    $date_heure = $futils->getDateTimeFr();
    $dtstamp = date("Y-m-d H:i:s");
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::INSERT_INTO_HISTO_AMINISTRATION_ACTION);
    $stmt->bindParam(":pAdmFk", $adm_fk, PDO::PARAM_INT);
    $stmt->bindParam(":pAdmEmail", $adm_email, PDO::PARAM_STR);
    $stmt->bindParam(":pActionCode", $adm_action_code, PDO::PARAM_STR);
    $stmt->bindParam(":pActionLibFonc", $adm_act_libfonc, PDO::PARAM_STR);
    $stmt->bindParam(":pDateHeureAction", $date_heure, PDO::PARAM_STR);
    $stmt->bindParam(":pDtStamp", $dtstamp, PDO::PARAM_STR);
    $stmt->bindParam(":pPkElement", $pk_element, PDO::PARAM_INT);
    $stmt->bindParam(":pTypeElement", $type_element, PDO::PARAM_STR);
    $stmt->bindParam(":pDenominationElement", $denomination_element, PDO::PARAM_STR);
    $stmt->bindParam(":pCommentaire", $commentaire, PDO::PARAM_STR);
    $stmt->execute();
  }

}