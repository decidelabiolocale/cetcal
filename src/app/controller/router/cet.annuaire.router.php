<?php

  /**
   * Dans ce code il faudra à terme non pas traiter les cas un à un mais appeler un controller qui 
   * lui fera le travail de construction et gestion de la route (ou url) demandée 
   * (+ envoi des paramètres pour ce faire).
   * 
   * proposition : Stocker les urls dans une table, puis deffinir un système d'indexation afin 
   * de toujours retrouver l'url (celle écrite en base) associée aux paramètres reçus (soit : 
   * $statut, $anr, $obl, $scope).
   */

  if (isset($cnx) && $cnx !== false) 
  {
    include $PHP_INCLUDES_PATH.'/areas/include.cet.annuaire.login.outcome.php';
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.slogan.php';
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.plateforme.php';
  }
  if (isset($obl) && $obl !== false) include $PHP_INCLUDES_PATH.'/areas/include.cet.annuaire.renouvellement.outcome.php';  

  if (!$anr && in_array($statut, CetQstProdFilArianneHelper::$statesFilAriane)) include $PHP_INCLUDES_PATH.'include.cet.qstprod.filarianne.php';
  $module = $PHP_INCLUDES_PATH.'include.cet.'.$scope.'.'.$statut.'.php';
  if (file_exists($module)) include $module;

  if ($anr && strcmp($statut, 'aboutus') === 0) {
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.aboutus.php';
  }

  /**
   * Nouveau code de routage ou include des vues ci-dessous :
   */
  if ($cnx === false && $obl === false && strcmp($statut, 'accueil.cet') === 0)
  {
    include $PHP_INCLUDES_PATH.'cartographie/include.cet.qstprod.cartographie.php';
    include $PHP_INCLUDES_PATH.'/recherche/include.cet.annuaire.searchbar.php';
    /**
     * Le 7/11/2021 : à décommenter (et commenter la searchbar temporaire ajouté ci-dessus), 
     * suite à fin des dévelopemments du module /homepage/include.cet.annuaire.searchbar.php.
     * include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.searchbar.php';
     */
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.slogan.php';
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.prd.a.lhonneur.php';
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.plateforme.php';
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.calltoaction.php';
    include $PHP_INCLUDES_PATH.'/homepage/include.cet.annuaire.calltoactionvisitor.php';
  }

?>