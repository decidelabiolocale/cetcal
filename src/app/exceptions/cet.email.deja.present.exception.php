<?php
/**
 *
 */
Class EmailDejaExistantException extends Exception
{

  const SUPER_MESSAGE = "[INSCRIPTION CETCAL impossible. email deja utilise : %s]";

  public function __construct($message = "Inscription impossible.", 
    $code = 0, Throwable $previous = null) 
  {
      parent::__construct($message, $code, $previous);
  }

  public function __toString() 
  {
      return __CLASS__ . ": [{$this->code}]: {sprintf(EmailDejaExistantException::SUPER_MESSAGE, $this->message)}\n";
  }

}