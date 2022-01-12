<?php
Class SessionHelper
{
  
  private $PHP_FILES_PATH = "/res/data/";
  private $doc_root = "";

  function __construct($DOC_ROOT) 
  {
    $this->doc_root = $DOC_ROOT;
  }

  public function getDto($dtoType, $dtoInstance)
  {
    $dto = isset($_SESSION[$dtoType]) ? unserialize($_SESSION[$dtoType]) : NULL;
    $dtoInstance = $dto;

    return $dtoInstance;
  }

  public function activateSessionUpdateContextSuperAdmin($sessionid)
  {
    session_id($sessionid);
    session_start();
    $_SESSION['CONTEXTE_MODIF-GLOBAL-SUPERADMIN'] = true;
    session_write_close();
  }

  public function unsetSessionUpdateContextSuperAdmin($sessionid)
  {
    session_id($sessionid);
    session_start();
    unset($_SESSION['CONTEXTE_MODIF-GLOBAL-SUPERADMIN']);
    session_write_close();
  }  

  public function setSessionUpdateContext($sessionid, $forms_questionnaire, $pk_producteur)
  {
    session_id($sessionid);
    session_start();
    $_SESSION['signupgen.form.post'] = $forms_questionnaire['signupgen.form.post'];
    $_SESSION['signuplieuxdist.form.post'] = $forms_questionnaire['signuplieuxdist.form.post'];
    $_SESSION['signupprods.form.post'] = $forms_questionnaire['signupprods.form.post'];
    $_SESSION['signupconso.form.post'] = $forms_questionnaire['signupconso.form.post'];
    $_SESSION['signupbesoins.form.post'] = $forms_questionnaire['signupbesoins.form.post'];
    $_SESSION['signuprecap.opinions'] = $forms_questionnaire['signuprecap.opinions'];
    $_SESSION['CONTEXTE_MODIF-signupgen'] = true;
    $_SESSION['CONTEXTE_MODIF-signuplieuxdist'] = true;
    $_SESSION['CONTEXTE_MODIF-signupprods'] = true;
    $_SESSION['CONTEXTE_MODIF-signupconso'] = true;
    $_SESSION['CONTEXTE_MODIF-signupbesoins'] = true;
    $_SESSION['CONTEXTE_MODIF-GLOBAL'] = true;
    $_SESSION['CONTEXTE_MODIF-PKPRD'] = $pk_producteur;
    session_write_close();
  }

  public function unsetSessionUpdateContext($sessionid)
  {
    session_id($sessionid);
    session_start();
    unset($_SESSION['signupgen.form.post']);
    unset($_SESSION['signuplieuxdist.form.post']);
    unset($_SESSION['signupprods.form.post']);
    unset($_SESSION['signupconso.form.post']);
    unset($_SESSION['signupbesoins.form.post']);
    unset($_SESSION['signuprecap.opinions']);
    unset($_SESSION['CONTEXTE_MODIF-signupgen']);
    unset($_SESSION['CONTEXTE_MODIF-signupprods']);
    unset($_SESSION['CONTEXTE_MODIF-signupconso']);
    unset($_SESSION['CONTEXTE_MODIF-signupbesoins']);
    unset($_SESSION['CONTEXTE_MODIF-GLOBAL']);
    session_write_close();
  }

}