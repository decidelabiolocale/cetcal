<?php
Class EncryptionUtils 
{

  public static function getProperties()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.filereader.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.properties.model.php');
    $mdl = new CETCALPropertiesModel();
    $freadr = new FileReaderUtils($_SERVER['DOCUMENT_ROOT']);
    $cyphed = $freadr->readFromCannonicalPathToString($_SERVER['DOCUMENT_ROOT'].'/res/data/properties/decidelabiolocale.properties');
    $cyphed = EncryptionUtils::decrypt($cyphed, $mdl->get());
    return $cyphed;
  }

  public static function encryptProperties()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.filereader.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.properties.model.php');
    $mdl = new CETCALPropertiesModel();
    $freadr = new FileReaderUtils($_SERVER['DOCUMENT_ROOT']);
    $cyphed = $freadr->readFromCannonicalPathToString($_SERVER['DOCUMENT_ROOT'].'/res/data/properties/decidelabiolocale.properties.json');
    $cyphed = EncryptionUtils::encrypt($cyphed, $mdl->get());
    error_log('[EncryptionUtils encryptProperties] '.$cyphed);
  }

  public static function encrypt($plaintext, $password) 
  {
    $method = "AES-128-CBC";
    $key = $password;
    $iv = $password;
    $ciphertext = base64_encode(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));
    error_log($ciphertext);
    return $ciphertext;
  }

  public static function decrypt($ciphertext, $password) 
  {
    $method = "AES-128-CBC";
    $iv = $password;
    $key = $password;
    return openssl_decrypt(base64_decode($ciphertext), $method, $key, OPENSSL_RAW_DATA, $iv);
  }

}