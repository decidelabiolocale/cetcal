<?php
Class CetQstProdFilArianneHelper
{
  public static $prefix_fa = "<span class=\"cet-qstprod-label-text\">Fil d'Ariane :</span>";
  private static $prefix = "";
  private static $values = array(
    "signupgen.form" => "Fiche d'identité (Et enquête)",
    "signuplieuxdist.form" => "Distribution",
    "signupprods.form" => "Produits",
    "signupconso.form" => "Vos consommateurs",
    "signupbesoins.form" => "Besoins, Solidarité et Résilience",
    "signuprecap.form" => "Récapitulatif du questionnaire",
    "signupeffectue.form" => "Confirmation d'inscription"
  );
  public static $states = array(
    "signupgen.form", "signuplieuxdist.form", "signupprods.form", "signupconso.form", "signupbesoins.form", "signuprecap.form", "signupeffectue.form"
  );
  public static $statesFilAriane = array(
    "signupgen.form", "signuplieuxdist.form", "signupprods.form", "signupconso.form", "signupbesoins.form", "signuprecap.form", "signupeffectue.form"
  );

  private static $result = "";

  public static function update($statut)
  {
    foreach (CetQstProdFilArianneHelper::$values as $k => $v) 
    {
      if (strcmp($statut, $k) == 0) 
      {
        CetQstProdFilArianneHelper::$result .= " <span class=\"badge\" style=\"color: white !important; background-color: #DD4215 !important; margin-bottom: 4px; font-size: 14px; font-weight: normal; padding: 6px;\">".CetQstProdFilArianneHelper::$prefix.$v."</span>";
      }
      else
      {
        CetQstProdFilArianneHelper::$result .= " <span class=\"badge badge-light\" style=\"margin-bottom: 4px; font-size: 14px; font-weight: normal; padding: 6px;\">".CetQstProdFilArianneHelper::$prefix.$v."</span>";
      }
    }

    return  CetQstProdFilArianneHelper::$result;
  }
}