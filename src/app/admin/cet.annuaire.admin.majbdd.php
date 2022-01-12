<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.refactoringbdd.model.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');

$data = new CETCALrefactoring();
$producteurs = $data->fetchProducteursWithMarche();
$isMarcheExists = new CETCALrefactoring();
$i = 0;
$pattern = "/[(,]+/";
$sanitize = new HTTPDataProcessor();
$insertData = new CETCALrefactoring();

foreach ($producteurs as $producteur){

    $q[$i] =  preg_split($pattern, $producteur->adresse_literale, 0, PREG_SPLIT_NO_EMPTY);
    $needle[$i] = $sanitize->accent2ascii(strtolower($q[$i][0]));
    $marcheEntite[$i] =  $isMarcheExists->compareMarche($q[$i][0]);
    $haystacks[$i]  = explode("Marché de ", $marcheEntite[$i]->denomination);
    $haystack[$i] = $sanitize->accent2ascii(strtolower($haystacks[$i][1]));
    $pos[$i] = strrpos(rtrim($haystack[$i]), rtrim($needle[$i]));

    if ($pos[$i] !== false) {

        echo "ok le marché ". $needle[$i] . " existe " . "dans " . $haystack[$i]  . " à la position " . $pos[$i];
        $insertData->insertProducteurLieuDistribution($producteur->fk_producteur_join, $marcheEntite[$i]->pk_entite);
    } else {
        echo'<pre>';
        //echo "non le marché " . $needle[$i] . "n'existe pas " . "dans " . $haystack[$i] . "à la position " . $pos[$i];
        echo'</pre>';
    }
    $i++;
}


