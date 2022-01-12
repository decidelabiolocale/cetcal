<?php
/**
 *
 */
Class LoginImpossibleException extends Exception
{

  const SUPER_MESSAGE = "[AUTH CETCAL impossible : %s]";

  public function __construct($message = "Authentification impossible.", 
    $code = 0, Throwable $previous = null) 
  {
      parent::__construct($message, $code, $previous);
  }

  public function __toString() 
  {
      return __CLASS__ . ": [{$this->code}]: {sprintf(LoginImpossibleException::SUPER_MESSAGE, $this->message)}\n";
  }

}