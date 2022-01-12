<?php
/**
 * Aide à la gestion du code PHP présent dans les vues de type *.form.php
 */
Class HtmlFormHelper
{

  function __construct() { }

  /**
   * Sur la base d'un tableau représentant la zone du formulaire avec saisie de type 
   * 'autre' (param 0), chercher l'élément qui n'est pas présent dans la liste de choix (param 1).
   * Si trouvé, retourner la partie saisie de la valeure. Sinon, retourner une chaine de char vide ou "néant".
   */
  public function getSaisieAutreSiExiste($saisies, $liste)
  {
    try 
    {
      if ($this->checkParams($saisies, $liste) === false) return ""; 
      $tmp = array();
      // Reconstruire un array comparable.
      foreach ($liste as $element) array_push($tmp, implode(';', $element));
      // Chercher dans l'array temporaire.
      $data = "";
      foreach ($saisies as $saisie)
      {
        if (in_array($saisie, $tmp) === false) 
        {
          $data = explode(';', $saisie);
          if (count($data) === 2) return $data[1]; 
          else return "";
        }
      }
      
      // Rien trouvé : retouner néant.
      return "";
    } 
    catch (Exception $e) 
    {
      error_log('[HtmlFormHelper erreur dans f->getSaisieAutreSiExiste] retourne neant.');
      return "";
    }
  }

  /**
   * vérification des tableaux en params d'entrés de la fonction public getSaisieAutreSiExiste.
   */ 
  private function checkParams($p1, $p2)
  {
    if (!isset($p1) || empty($p1) || !is_array($p1) || count($p1) === 0 ||
        !isset($p2) || empty($p2) || !is_array($p2) || count($p2) === 0) 
    {
      return false;
    }
    else
    {
      return true;
    }
  }

}