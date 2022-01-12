<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class AdminMarchesCastillonnaisController extends AnnuaireController
{

  function __construct() { }

  public function insertMarche($post)
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
      $dataProcessor = new HTTPDataProcessor();
      $data = array();

      // POST form logic - dans l'ordre du formulaire HTML :
      $data['denomination'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-denomination']) ? $post['entite-marche-denomination'] : NULL);
      $data['territoire'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-territoire']) ? $post['entite-marche-territoire'] : NULL);
      $data['activite'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-activite']) ? $post['entite-marche-activite'] : NULL);
      $data['adr'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-adresse']) ? $post['entite-marche-adresse'] : NULL);
      $data['tel'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-tel']) ? $post['entite-marche-tel'] : NULL);
      $data['personne'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-personne']) ? $post['entite-marche-personne'] : NULL);
      $data['email'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-email']) ? $post['entite-marche-email'] : NULL);
      $data['urlwww'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-urlwww']) ? $post['entite-marche-urlwww'] : NULL);
      $data['infoscmd'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-infoscmd']) ? $post['entite-marche-infoscmd'] : NULL);
      $data['jourh'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-jourhoraire']) ? $post['entite-marche-jourhoraire'] : NULL);
      $data['specificite'] = $dataProcessor->processHttpFormData(
        isset($post['entite-marche-specificites']) ? $post['entite-marche-specificites'] : NULL);
      $data['type'] = 'marche'; // c'est un marché donc type 'marche' en dure.

      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      $model->insertEntite($data);
    }
    catch (Exception $e) 
    {
      var_dump($e);
    }

    return true;
  }

  public function selectByPk($pk)
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      return $model->selectByPk($pk); 
    }
    catch (Exception $e) 
    {
      var_dump($e);
    }
    return false;
  }

}