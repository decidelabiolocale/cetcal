<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use \Mailjet\Resources;

/** 
 * Helper pour mailjet.
 */
Class CETMailjetHelper
{

  private $properties;
  const FROM = "Annuaire CETCAL.site";
  const EMAIL = "annuaire@castillonnaisentransition.org";
  const EMAIL_PROTONMAIL = 'cetcal@protonmail.com';
  const SUBJECT_PREFIX = "";

  public function __construct() 
  { 
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.cryption.php');
    $this->properties = json_decode(EncryptionUtils::getProperties(), true);
  }

  public function send($mailFileHTML, $mailFilePlain, $mailTo, $mailSubject, $fileReader, $dataFilePrefix, 
    $key = false, $value = false)
  {
    $htmlContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFileHTML);
    $plainContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFilePlain);
    
    if ($key !== false && $value !== false) 
    {
      $htmlContent = str_replace($key, $value, $htmlContent);
      $plainContent = str_replace($key, $value, $plainContent);
    }

    $success = $this->callApi($mailTo, $mailSubject, $htmlContent, $plainContent);

    return true;
  }

  public function send_paramsMultiples($mailFileHTML, $mailFilePlain, $mailTo, $mailSubject, $fileReader, $dataFilePrefix, $params = false)
  {
    $htmlContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFileHTML);
    $plainContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFilePlain);
    
    if ($params !== false) 
    {
      foreach ($params as $key => $value) 
      {
        $htmlContent = str_replace($key, $value, $htmlContent);
        $plainContent = str_replace($key, $value, $plainContent);
      }
    }

    $success = $this->callApi($mailTo, $mailSubject, $htmlContent, $plainContent);
  }

  private function callApi($mailTo, $mailSubject, $htmlContent, $plainContent)
  {
    try 
    {

      $mj = new \Mailjet\Client(
        $this->properties['properties']['mailjet']['token'],
        $this->properties['properties']['mailjet']['secret'],
        true,
        ['version' => 'v3.1']
      );

      $body = [
        'Messages' => [
          [
            'From' => [
              'Email' => CETMailjetHelper::EMAIL_PROTONMAIL,
              'Name' => CETMailjetHelper::FROM
            ],
            'To' => [
              [
                'Email' => $mailTo
              ]
            ],
            'Subject' => CETMailjetHelper::SUBJECT_PREFIX.$mailSubject,
            'TextPart' => $plainContent,
            'HTMLPart' => $htmlContent
          ]
        ]
      ];

      $response = $mj->post(Resources::$Email, ['body' => $body]);
      //$response->success() && var_dump($response->getData());

      return true;
    } 
    catch (Exception $e) 
    {
      error_log($e->getMessage());
      return false;
    }
  }

}