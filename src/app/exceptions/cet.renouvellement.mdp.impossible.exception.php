<?php
/**
 *
 */
Class ResetEnvoiMdpImpossibleException extends Exception
{

  const SUPER_MESSAGE = "[Renouvellement de mot de passe CETCAL impossible : %s]";

  public function __construct($message = "Envoi du mot de passe temporaire impossible.", 
    $code = 0, Throwable $previous = null) 
  {
      parent::__construct($message, $code, $previous);
  }

  public function __toString() 
  {
      return __CLASS__ . ": [{$this->code}]: {sprintf(ResetEnvoiMdpImpossibleException::SUPER_MESSAGE, $this->message)}\n";
  }

}