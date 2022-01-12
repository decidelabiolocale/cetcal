<?php
/**
 * Abstract MODEL class.
 */
class CETCALDeoucpeCSVProducteur 
{

  /**
   * SQL query library.
   */
  private $querylib;
  private $raw_data = [];
  private $insert_values = [];
  
  function __construct() 
  {
  }

  public function decoupe($file) 
  {
    $handle = fopen($file, "r");
    if ($handle) 
    {
      while (($line = fgets($handle)) !== false) 
      {
        // Colonne du CSV de Céline :
        /* **************************************
         * nom_fermre
         * raison_sociale
         * desc_produits
         * adresse
         * tel
         * email
         * url
         * nom_prenom
         * animations_ferme
         * partenaires
         * lieux_cal
         * label
         * infos
         * assos
         * marches
         * autres_cal
         ****************************************/
        $tmp = explode('§', $line);
        array_push($this->raw_data, [
          "nom_ferme" => empty($tmp[0]) ? $tmp[1] : $tmp[0], 
          "raison_sociale" => $tmp[1], 
          "desc_produits" => $this->strToArrayTrimData($tmp[2]),
          "adresse" => $tmp[3], 
          "tel" => $this->strToArrayTrimData($tmp[4]),
          "email" => $this->strToArrayTrimData($tmp[5]), 
          "url" => $this->strToArrayTrimData($tmp[6]), 
          "nom_prenom" => $tmp[7], 
          "animations_ferme" => $tmp[8],
          "partenaires" => $tmp[9], // non pris en compte au 28/01/2021
          "lieux_cal" => $this->strToArrayTrimData($tmp[10]),
          "label" => $this->strToArrayTrimData($tmp[11]),
          "infos" => $tmp[12], // non pris en compte au 28/01/2021
          "assos" => $tmp[13], // non pris en compte au 28/01/2021
          "marches" => $this->strToArrayTrimData($tmp[14]),
          "autres_cal" => $tmp[15] // non pris en compte au 28/01/2021
        ]);

        /* ********************************************************************************
         * afin de péréniser c'est données, il faut étendre les champs de la table 
         * cetcal_producteur avec ajouts des champs suivant : 
         * - <email_mltpl VARCHAR(256)> (pour les cas avec < 1 email dans le csv de Céline). Dans 
         * les cas de emails multiples, le premier alimentera cetcal_producteur.email et email_bu.
         * Le champs email_mltpl contiendra les N emails du csv. Dans le cas ou la ligne du CSV
         * ne contient qu'un seul email, alors email_mltpl n'est pas alimenté et les chmaps email
         * et email_bu portent l'email unique (comme pour une inscription).
         * - <tels_mltpl VARCHAR(128)> idem que pour emails.
         * - <desc_produits_ltrl VARCHAR(2048)> (pour porter les données produits sans les écrire dans 
         * les tables cetcal_produit car cette cernière nécessite des entrées atomiques).
         * Le champ desc_produits portera une description litérale des produits et 
         * catégories de produits mélangés. Tel quel, les données produits du CSV de 
         * Céline ne permettent pas une automatisation csv vers tables cetcal.
         * - <adrferme_ltrl VARCHAR(512)> (pour porter l'adresse complète et non pas des données
         * adresse découpées comme c'est le cas pour l'inscription producteur via cetcal).
         * - <denomination_producteur VARCHAR(60)> (pour porter les données nom et prénom qui sont
         * fortement couplés dans le csv : il est donc impossible dans ce csv de distinguer
         * le nom du prénom).
         * - <lieux_distribution_ltrl VARCHAR(512)> (les lieux. Idem données trop fortement couplées).
         * - <marches_ltrl> (même problème insolvable).
         * - <label_ltrl VARCHAR(60)> : contient les données de la colonne label du csv (sous forme de
         * chaine de caractère - les labels étant séparés par une virgule).
         * - <infos_ltrl VARCHAR(1024)> : contient les données infos + autre_cal + assos + partenaires.
         * 
         * Données NOT NULL de la table cetcal_producteur : tous les champs avec contrainte
         * NOT NULL seront affectés avec '0'.
         * 
         ***********************************************************************************/

      }
      fclose($handle);
    }
    else 
    {
      error_log("CETCALDeoucpeCSVProducteur : impossible d'ouvrir ou lire le fichier ".$file);
    } 

    $this->buildInsertValues();
  }

  private function buildInsertValues()
  {
    array_push($this->insert_values, sprintf("INSERT INTO cetcal_producteur (%s) VALUES ",
      "denomination_producteur, email_mltpl, desc_produits_ltrl, adrferme_ltrl, ".
      "tels_mltpl, lieux_distribution_ltrl, marches_ltrl, label_ltrl, infos_ltrl, urls_mltpl, ".
      "email, email_bu, telfixe, telport, nom_ferme, pageurl_fb, pageurl_ig, pageurl_twitter, ".
      "mdpsha, adrferme_commune, adrferme_cp, identifiant_cet"
    )); 
    foreach ($this->raw_data as $data)
    {      
      /**
       * SI email déjà existant alors le producteur présent dans les données de Céline est 
       * déjà inscrit via cetcal.site. Ne pas l'insert en doublon donc.
       */
      if ($this->emailExists($data['email']) > 0) 
      {
        error_log("[DEJA INSCRIT] Producteur deja inscrit adrferme_ltrl=".$data['adresse']." nom_ferme=".$data['nom_ferme']);
        continue;
      }

      array_push($this->insert_values, 
        sprintf('("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s",'.
          '"%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")', 
          $data['nom_prenom'],
          $this->arrayToString($data['email'], ','),
          $this->arrayToString($data['desc_produits'], ','),
          $data['adresse'],
          $this->trimAndExtractSpaces($this->arrayToString($data['tel'], ',')),
          $this->arrayToString($data['lieux_cal'], ','),
          $this->arrayToString($data['marches'], ','),
          $this->arrayToString($data['label'], ','),
          $data['autres_cal'].$data['assos'].$data['infos'],
          $this->arrayToString($data['url'], ','),
          $this->getFirstEmail($data['email']),
          $this->getFirstEmail($data['email']),
          $this->getTelFixe($data['tel']),
          $this->getTelPort($data['tel']),
          $data['nom_ferme'],
          $this->getUrlCible($data['url'], 'facebook'),
          $this->getUrlCible($data['url'], 'instagram'),
          $this->getUrlCible($data['url'], 'twitter'),
          "0", // mdpsha NOT NULL
          "0", // adrferme_commune NOT NULL
          "0", // adrferme_cp NOT NULL
          "0" // identifiant_cet NOT NULL
        ));
    }

    echo '<p>';
    foreach ($this->insert_values as $value) echo $value.',<br>';
    echo '</p>';
  }

  private function emailExists($emailArray)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
    $model = new QSTPRODProducteurModel();
    foreach ($emailArray as $email) 
    {
      $v = $model->emailExists(trim($email));
      if ($v > 0) return $v;
    }
    return 0; 
  }

  private function trimAndExtractSpaces($string)
  {
    return trim(str_replace(' ', '', $string));
  }

  private function getUrlCible($urls, $target)
  {
    foreach ($urls as $url) 
    {
      if (strpos($url, $target) === false) continue;
      else return trim($url); 
    }

    return '';
  }

  private function getTelPort($tels) 
  {
    if (is_array($tels) && count($tels) > 0)
    {
      foreach ($tels as $tel) 
      {
        if (strlen($tel) >= 10 && (substr(trim(str_replace(' ', '', $tel)), 0, 2) === '06' 
          || substr(trim(str_replace(' ', '', $tel)) === '07'))) return trim(str_replace(' ', '', $tel));
        else return '';
      }
    } 
    else
    {
      return '';
    }
  }

  private function getTelFixe($tels)
  {
    if (is_array($tels) && count($tels) > 0)
    {
      foreach ($tels as $tel) 
      {
        if (strlen($tel) >= 10 && substr(trim(str_replace(' ', '', $tel)), 0, 2) !== '06' 
          && substr(trim(str_replace(' ', '', $tel)), 0, 2) !== '07') return trim(str_replace(' ', '', $tel));
        else return '';
      }
    } 
    else
    {
      return '';
    }
  }

  private function getFirstEmail($emails)
  {
    return trim($emails[0]);
  }

  private function arrayToString($array, $separator)
  {
    $tmp_str = '';
    // TODO replace all '"' chars by nothing.
    foreach ($array as $value) $tmp_str .= trim(str_replace('"', '', $value)).$separator;
    return substr($tmp_str, 0, -1);
  }

  private function strToArrayTrimData($data)
  {
    $bu_array = [];
    try
    {
      $tmp = explode(',', $data);
      for ($i = 0; $i < $tmp.length; ++$i) 
      { 
        $tmp[$i] = trim($tmp[$i]);
      }

      return $tmp;
    }
    catch (Exception $e)
    {
      return $bu_array;
    }
  }

}