<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

/**
 * Gestion des coordonnées Latitude, Longitude.
 */
class CETCALCartographieLoader
{

  private $properties;
  const TYPES_ENTITES_A_CARTOGRAPHIER = ['marche', 'mbio', 'amap'];

  function __construct() 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.cryption.php');
    $this->properties = json_decode(EncryptionUtils::getProperties(), true);
  }

  /**
   * cartographie des entités. Table cetcal.cetcal_entite.
   */
  public function loadEntites($data)
  {
    $latLng = NULL;
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $model = new CETCALCartographieModel();
    
    foreach ($data as $entiteDto)
    {
      if ($model->existsEntite($entiteDto->getPk()))
      {
        $latLng = $model->getLatLngEntite($entiteDto->getPk());
        if (strcmp($latLng[0], 'ERROR') === 0 || strcmp($latLng[0], 'ERROR') === 0) continue;
        $entiteDto->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      }
      else
      {
        try
        {
          $client = new Client();
          $response = $client->get('https://api.mapbox.com/geocoding/v5/mapbox.places/'.$entiteDto->adresse.'.json?limit=1&country=FR&access_token=pk.eyJ1IjoiZGVjaWRlbGFiaW9sb2NhbGUiLCJhIjoiY2t4c3J1b3pmMTV4cDJzbXZ6aWtxOTNrbiJ9.UrHhSVL477MEsqwLPJubrQ', 
            ['synchronous' => true]);
          $latLng = $this->forwardGeocoderMapbox(json_decode($response->getBody()->getContents()));
          $model->insertEntite($latLng, $entiteDto->getPk());
          $entiteDto->setLatLng($latLng[0], $latLng[1]);
        }
        catch (Exception $e)
        {
          $model->insertEntite(['ERROR', 'ERROR'], $entiteDto->getPk());
          error_log("[CETCAL.CETCALCartographieLoader] error loading geocodes for pk_entite=".$entiteDto->getPk()." error=".$e->getMessage(), 0);
        }
      }
    }

    return $data;
  }

  /**
   * cartographie des communes. Table cetcal.cetcal_communes.
   */
  public function loadCommunes()
  {
    $communes = [];
    $latLng = NULL;
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.communes.model.php');
    $model = new CETCALCommunesModel();
    $data = $model->selectAll();

    foreach ($data as $row)
    {
      try
      {
        if ($model->hasGeolocData($row['id']) == true) continue;

        error_log("[CETCALCartographieLoader] Appel positionstack pour commune=".$row['libelle']);
        $query = http_build_query([
          'access_key' => '7d2e9d0e589e6cdcac9fde7e403c6b41',
          'query' => $row['libelle'].' FRANCE',
          'output' => 'json'
        ]);
        $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $query));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        $latLng = $this->forwardGeocoderPositionstack($result);
        $row['lat'] = $latLng[0];
        $row['lng'] = $latLng[1];
        $model->update($row, $latLng[0], $latLng[1]);
        array_push($communes, $row);
        error_log("[CETCALCartographieLoader] OK geoloc positionstack pour commune=".$row['libelle']);
      }
      catch (Exception $e)
      {
        error_log("[CETCAL.CETCALCartographieLoader] error loading geocodes for commune=".$row['libelle']."... .. ... .. .".$e->getMessage());
      }
    }

    return $communes;
  }

  /**
   * cartographie des producteurs. Table cetcal_producteur.
   */
  public function load($data)
  {
    $latLng = NULL;
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $model = new CETCALCartographieModel();

    foreach ($data as $prdDto)
    {
      if ($model->exists($prdDto->getPk()))
      {
        $latLng = $model->getLatLng($prdDto->getPk());
        if (strcmp($latLng[0], 'ERROR') === 0 || strcmp($latLng[0], 'ERROR') === 0) continue;
        $prdDto->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      }
      else
      {
        try
        {
          error_log("[CETCALCartographieLoader] Appel mapbox pour producteur pk=".$prdDto->getPk());
          $adr = $prdDto->prodInscrit === 'false' ? $prdDto->adrfermeLtrl : 
            (is_numeric($prdDto->adrNumvoie) ? $prdDto->adrNumvoie : '').
            '%20'.$prdDto->adrRue.'%20'.$prdDto->adrLieudit.'%20'.$prdDto->adrCommune.'%20'.
            (is_numeric($prdDto->adrCodePostal) ? $prdDto->adrCodePostal : '').'%20'.$prdDto->adrComplementAdr;
          error_log("[CETCALCartographieLoader] adresse producteur definie pour geoloc(pk=".$prdDto->getPk().")=".$adr);
          if (empty($adr) || strlen($adr) <= 5) continue;
          $client = new Client();
          $response = $client->get('https://api.mapbox.com/geocoding/v5/mapbox.places/'.$adr.'.json?limit=1&country=FR&access_token=pk.eyJ1IjoiZGVjaWRlbGFiaW9sb2NhbGUiLCJhIjoiY2t4c3J1b3pmMTV4cDJzbXZ6aWtxOTNrbiJ9.UrHhSVL477MEsqwLPJubrQ', 
            ['synchronous' => true]);
          $latLng = $this->forwardGeocoderMapbox(json_decode($response->getBody()->getContents()));
          $model->insert($latLng, $prdDto->getPk());
          $prdDto->setLatLng($latLng[0], $latLng[1]);
        } 
        catch (Exception $e)
        {
          error_log("[CETCAL.CETCALCartographieLoader] error loading geocodes for pk_producteur=".$prdDto->getPk()." error=".$e->getMessage(), 0);
          $model->insert(['ERROR', 'ERROR'], $prdDto->getPk());
          $prdDto->setLatLng($latLng[0], $latLng[1]);
        }
      }
    }

    return $data;
  }

  /**
   * Spécifique api positionstack.
   */
  private function forwardGeocoderPositionstack($data) 
  {
    $geoloc = $data['data'];
    return [$geoloc[0]['latitude'].'', $geoloc[0]['longitude'].''];
  }

  /**
   * Spécifique à l'API mapbox.
   */
  private function forwardGeocoderMapbox($data) 
  {
    for ($i = 0; $i < count($data->features); $i++) 
    {
      $feature = $data->features[$i];
      if ($feature->geometry->coordinates !== 'undefined') return $feature->geometry->coordinates;
    }
    return NULL;
  }

}
