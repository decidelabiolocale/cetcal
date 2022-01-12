<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALPropertiesModel extends CETCALModel 
{
  
  public function get()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PROPERTIES);
    $stmt->execute();
    $data = $stmt->fetch();

    return $data['decipher'];
  }

}