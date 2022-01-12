<?php
Class IdentifiantCETHelper
{

  public $identifiant;

  function __construct() 
  {
  }

  function generateId($pEmail, $pTelFixe, $pTelMobil)
  {
    if (isset($pEmail) && strlen($pEmail) > 0) return $pEmail;
    else if (isset($pTelMobil) && strlen($pTelMobil) >= 10) return $pTelMobil;
    else if (isset($pTelFixe) && strlen($pTelFixe) >= 10) return $pTelFixe;
    else throw new Exception("Il nous est impossible de generer un identifiant de connexion car ni l'email, le numero de telephone mobile ou fixe ne sont renseignes.");
  }

  function generateRandomString($length = 10) 
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) 
    {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

}