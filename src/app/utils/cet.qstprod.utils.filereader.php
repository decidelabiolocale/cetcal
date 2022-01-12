<?php
Class FileReaderUtils
{
  private $PHP_FILES_PATH = "/res/data/datafiles/";
  private $PHP_MAIL_FILES_PATH = "/res/data/mail/";
  private $doc_root = "";
  public $temp = NULL;
  private $commenttag = "#";

  function __construct($DOC_ROOT) 
  {
    $this->doc_root = $DOC_ROOT;
  }

  public function read($fileName)
  {
    if (file_exists($this->doc_root.$this->PHP_FILES_PATH.$fileName))
    {
      $this->temp = array();
      $file = fopen($this->doc_root.$this->PHP_FILES_PATH.$fileName, "r");
      while(!feof($file)) array_push($this->temp, trim(fgets($file)));
      fclose($file);
      return $this->temp;
    }
  }

  public function readFromCannonicalPath($cannonicalPath)
  {
    if (file_exists($cannonicalPath))
    {
      $this->temp = array();
      $file = fopen($cannonicalPath, "r");
      while(!feof($file)) array_push($this->temp, trim(fgets($file)));
      fclose($file);
      return $this->temp;
    }
    else
    {
      return 'file does not exist...';
    }
  }

  public function readFromCannonicalPathToString($cannonicalPath)
  {
    if (file_exists($cannonicalPath))
    {
      $this->temp = '';
      $file = fopen($cannonicalPath, "r");
      while(!feof($file)) $this->temp .= trim(fgets($file));
      fclose($file);
      return $this->temp;
    }
    else
    {
      return 'file does not exist...';
    }
  }

  public function readWithKV($fileName, $pSortAlphabetique = false)
  {
    if (file_exists($this->doc_root.$this->PHP_FILES_PATH.$fileName))
    {
      $line = "";
      $this->temp = array();
      $file = fopen($this->doc_root.$this->PHP_FILES_PATH.$fileName, "r");
      while(!feof($file)) 
      {
        $line = trim(fgets($file));
        if (substr($line, 0, 1) == $this->commenttag) continue;
        else array_push($this->temp, explode(";", strtolower($line)));
      }
      fclose($file);

      return $this->temp;
    }
  }

  public function readQAFile($fileName)
  {
    if (file_exists($this->doc_root.$this->PHP_FILES_PATH.$fileName))
    {
      $a = [];
      $q = true;
      $tmp = "";
      $this->temp = array();
      $file = fopen($this->doc_root.$this->PHP_FILES_PATH.$fileName, "r");
      while(!feof($file)) 
      {
        $tmp = trim(fgets($file));
        array_push($a, explode(";", $tmp));

        if (substr($tmp, 0, 1) == "#") 
        {
          array_push($this->temp, $a); 
          $a = [];      
        }
      }
      
      fclose($file);
      return $this->temp;
    }
  }

  /** **********************************************************************************
   * Pour mails spécifiquement.
   */
  public function readAsStringForMails($fileName)
  {
    if (file_exists($this->doc_root.$this->PHP_MAIL_FILES_PATH.$fileName))
    {
      $this->temp = "";
      $file = fopen($this->doc_root.$this->PHP_MAIL_FILES_PATH.$fileName, "r");
      while(!feof($file)) $this->temp = $this->temp.trim(fgets($file));
      fclose($file);
      return $this->temp;
    }
  }

  public function readForMails($fileName)
  {
    if (file_exists($this->doc_root.$this->PHP_MAIL_FILES_PATH.$fileName))
    {
      $this->temp = array();
      $file = fopen($this->doc_root.$this->PHP_MAIL_FILES_PATH.$fileName, "r");
      while(!feof($file)) array_push($this->temp, trim(fgets($file)));
      fclose($file);
      return $this->temp;
    }
  }

  public function listFiles($dir)
  {
    $files = array_diff(scandir($dir), array('.', '..'));
    $tmp = array();
    foreach ($files as $file) array_push($tmp, $dir.'/'.$file);
    return $tmp;
  }

  /** **********************************************************************************
   * Sort functions.
   */

  private function alphaSort($arrayKV)
  {
    $clef = ""; 
    $tmpArray = array();
    $autre = false;
    foreach ($arrayKV as $value) 
    {
      $clef = $value[0];
      if (strcasecmp($value[1], 'autre') == 0) $autre = true;
      else array_push($tmpArray, $value[1]);
    }

    $resArray = array();
    sort($tmpArray);
    foreach ($tmpArray as $sval) array_push($resArray, array($clef, $sval));
    if ($autre) array_push($resArray, array($clef, 'autre'));

    return $resArray;
  }

}