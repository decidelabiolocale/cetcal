<?php
Class FormatUtils 
{

  const WEEK_DAY_FR = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
  const MONTH_FR = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

  public function __construct() {}

  public function formatNTel($tel) 
  {
    try 
    {
      $tel = trim($tel);
      $ftel = '';
      if (strlen($tel) != 10) return $tel;
      else
      {
        for ($i = 0; $i < strlen($tel); $i++) 
        {
          $ftel .= (($i % 2 == 0) || $i == 9) ? $tel[$i] : $tel[$i].'-';
        } 
        return $ftel;
      }
    }
    catch (Exception $e)
    {
      return $tel;
    }
  }

  public function getDateTimeFr() 
  {
    $datetime = getdate();
    return FormatUtils::WEEK_DAY_FR[$datetime['wday'] - 1]
      .' '.$datetime['mday']
      .' '.FormatUtils::MONTH_FR[$datetime['mon'] - 1]
      .' '.$datetime['year']
      .' à '.$this->appendCharIf($datetime['hours'], 1, '0')
      .'h'.$this->appendCharIf($datetime['minutes'], 1, '0');
  }

  public function appendCharIf($value, $nbr, $char)
  {
    return (strlen($value) == $nbr) ? $char.$value : $value;
  }

  public function formatTypesProduction($libelle) 
  {
    $res = '';
    $data = explode('µ', $libelle);
    foreach ($data as $info) if (!empty($info) && strlen($info) > 2) $res .= trim($info).', ';
    return substr($res, 0, strlen($res) - 2);
  }

  public function separatorToComaSpace($separator, $text)
  {
    return str_replace($separator, ', ', $text);
  }

  public function formatDenominationUpperCases($libelle) 
  {
    $res = '';
    $data = explode(' ', $libelle);
    foreach ($data as $info) if (!empty($info) && strlen($info) > 2) $res .= ucfirst(trim($info)).' ';
    return substr($res, 0, strlen($res) - 1);
  }

}