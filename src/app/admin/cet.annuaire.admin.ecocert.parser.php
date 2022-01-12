<?php
$handle = fopen($_SERVER['DOCUMENT_ROOT'].'/database/ecocert24', "r");
if ($handle) 
{
  while (($line = fgets($handle)) !== false) 
  {
    if (strpos($line, 'style="width:65%"') > 0) 
    {
      $tmp = explode('<br>', $line);
      echo 'INSERT INTO cetcal_biodata (dept, denomination, adr_certification, id_certification, source) VALUES (24,"';
      echo trim(strip_tags($tmp[0])).'","'.trim(strip_tags($tmp[1])).'"';
    }
    else if (strpos($line, 'style="width:35%') > 0)
    {
      $tmp = substr($line, strpos($line, 'href="') + 41, 36);
      echo ',"'.trim($tmp).'", "ecocert");<br>';
    }
  }
  fclose($handle);
}
else 
{
  echo "impossible d'ouvrir ou lire le fichier";
}