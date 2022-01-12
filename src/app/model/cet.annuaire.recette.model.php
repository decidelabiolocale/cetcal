<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.+ for recette CETCAL.
 */
class CETCALRecetteModel extends CETCALModel 
{

  /**
   * titre => "",
   * nombre_personnes => "",
   * temps_cuisson => "",
   * temps_preparation => "",
   * ingredients => "",
   * recette => "",
   * ingredients_et_recette => "",
   * notes => "",
   * auteurs => ""
   */
  public function insertFromArray($data)
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_RECETTE);

      $stmt->bindParam(":pTitre", $data['titre'], PDO::PARAM_STR);
      $stmt->bindParam(":pNbrPersonnes", $data['nombre_personnes'], PDO::PARAM_STR);
      $stmt->bindParam(":pTpsCuisson", $data['temps_cuisson'], PDO::PARAM_STR);
      $stmt->bindParam(":pTpsPreparation", $data['temps_preparation'], PDO::PARAM_STR);
      $stmt->bindParam(":pIngredients", $data['ingredients'], PDO::PARAM_STR);
      $stmt->bindParam(":pRecette", $data['recette'], PDO::PARAM_STR);
      $stmt->bindParam(":pIngredientsEtRecette", $data['ingredients_et_recette'], PDO::PARAM_STR);
      $stmt->bindParam(":pNotes", $data['notes'], PDO::PARAM_STR);
      $stmt->bindParam(":pAuteurs", $data['auteurs'], PDO::PARAM_STR);
      $stmt->bindParam(":pFilePath", $data['file_path'], PDO::PARAM_STR);
      $stmt->bindParam(":pMotsClesProduits", $data['mots_cles_produits'], PDO::PARAM_STR);
      $stmt->execute();
    }
    catch (Exception $e)
    {
      error_log($e);
    }
  }

  public function selectAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CETCAL_RECETTES);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

}