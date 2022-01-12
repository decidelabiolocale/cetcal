<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

/** 
 *
 */
Class CETQstprodMailUtils
{

  private $err_list;
  private $mail;

  public function __construct()
  {
    $this->err_list = array();
    $this->mail = new PHPMailer(true); // True = activation des exception phpmailer.
  }

  public function init($debug = false)
  {
    if ($debug) $this->mail->SMTPDebug = 2;
    $this->mail->IsSMTP();
    $this->mail->SMTPAuth = true; 
    $this->mail->SMTPSecure = 'ssl'; 
    $this->mail->Host = 'mail.gandi.net';
    $this->mail->Port = 465;
    $this->mail->Username = "annuaire@castillonnaisentransition.org";
    $this->mail->Password = "";
    $this->mail->CharSet = 'UTF-8';
    $this->mail->setFrom('annuaire@castillonnaisentransition.org', 'CETCAL - Annuaire des producteurs de notre région');
  }

  public function sendSignupUser($mailFileHTML, $mailFilePlain, $emailTo, $mailSubject, $fileReader, 
    $dataFilePrefix)
  {
    $htmlContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFileHTML);
    $plainContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFilePlain);

    try 
    {
      $this->mail->addAddress($emailTo);
      $this->mail->addReplyTo('annuaire@castillonnaisentransition.org', 'CETCAL contact');
      $this->mail->isHTML(true);
      $this->mail->Subject = $mailSubject;
      $this->mail->Body = $htmlContent;
      $this->mail->AltBody = $plainContent;
      $this->mail->send();
      $this->mail->ClearAllRecipients();
      $this->mail->ClearCCs();
      $this->mail->ClearBCCs();
    }
    catch (Exception $e) 
    {
      array_push($this->err_list, "Erreur envoi Email unitaire: {$this->mail->ErrorInfo}");
      error_log("Erreur appel ->send() pour envoi Email unitaire: ".$e->getMessage());
    }

    return;
  }

  public function sendSignup($mailFileHTML, $mailFilePlain, $emailTo, $mailSubject, $fileReader, 
    $dataFilePrefix, $idcetwww)
  {
    $htmlContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFileHTML);
    $htmlContent = str_replace('[idcetwww]', $idcetwww, $htmlContent);
    $plainContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFilePlain);
    $plainContent = str_replace('[idcetwww]', $idcetwww, $plainContent);

    try 
    {
      $this->mail->addAddress($emailTo);
      $this->mail->addReplyTo('annuaire@castillonnaisentransition.org', 'CETCAL contact');
      $this->mail->isHTML(true);
      $this->mail->Subject = $mailSubject;
      $this->mail->Body = $htmlContent;
      $this->mail->AltBody = $plainContent;
      $this->mail->send();
      $this->mail->ClearAllRecipients();
      $this->mail->ClearCCs();
      $this->mail->ClearBCCs();
    }
    catch (Exception $e) 
    {
      array_push($this->err_list, "Erreur envoi Email unitaire: {$this->mail->ErrorInfo}");
      error_log("Erreur appel ->send() pour envoi Email unitaire: ".$e->getMessage());
    }

    return;
  }

  public function sendRenouvellementMDP($mailFileHTML, $mailFilePlain, $emailTo, $mailSubject, 
    $fileReader, $dataFilePrefix, $mdp_tmp)
  {
    $htmlContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFileHTML);
    $htmlContent = str_replace('[idcetwww]', $mdp_tmp, $htmlContent);
    $plainContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFilePlain);
    $plainContent = str_replace('[idcetwww]', $mdp_tmp, $plainContent);

    try 
    {
      $this->mail->addAddress($emailTo);
      $this->mail->addReplyTo('annuaire@castillonnaisentransition.org', 'CETCAL contact');
      $this->mail->isHTML(true);
      $this->mail->Subject = $mailSubject;
      $this->mail->Body = $htmlContent;
      $this->mail->AltBody = $plainContent;
      $this->mail->send();
      $this->mail->ClearAllRecipients();
      $this->mail->ClearCCs();
      $this->mail->ClearBCCs();
    }
    catch (Exception $e)
    {
      array_push($this->err_list, "Erreur envoi Email unitaire: {$this->mail->ErrorInfo}");
      error_log("Erreur appel ->send() pour envoi Email unitaire: ".$e->getMessage());
      return false;
    }

    return true;
  }

  public function send($mailFileHTML, $mailFilePlain, $mailListFile, $mailSubjectFile, $fileReader, $dataFilePrefix)
  {
    $htmlContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFileHTML);
    $plainContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFilePlain);
    $mailList = $fileReader->readForMails($dataFilePrefix.$mailListFile);
    $mailSubject = $fileReader->readAsStringForMails($dataFilePrefix.$mailSubjectFile);

    try {
    
      foreach ($mailList as $adrmail)
      {
        try 
        {
          $this->mail->addAddress($adrmail);
          $this->mail->addReplyTo('annuaire@castillonnaisentransition.org', 'CETCAL contact');
          $this->mail->isHTML(true);
          $this->mail->Subject = $mailSubject;
          $this->mail->Body = $htmlContent;
          $this->mail->AltBody = $plainContent;
          $this->mail->send();
          $this->mail->ClearAllRecipients();
          $this->mail->ClearCCs();
          $this->mail->ClearBCCs();
        }
        catch (Exception $e) 
        {
          array_push($this->err_list, "Erreur envoi Email groupé: {$this->mail->ErrorInfo}");
        }
      }
    } 
    catch (Exception $e) 
    {
      array_push($this->err_list, "Erreur envoi Email generale: {$this->mail->ErrorInfo}");
    }
  }

}