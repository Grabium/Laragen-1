<?php
namespace Laragen\App;

class Json
{
  public static function getJson(string $file):array
  {
    if(!file_exists($file)){
      exit($file.$lang['l1003'].__CLASS__.$lang['l1004'].__LINE__);
    }
    
    $jsonFile = file_get_contents($file);
    $arrayFileContent = json_decode($jsonFile, true);
    return $arrayFileContent;
  }

  public static function setJson(string $file, array $content)
  {
    $jsonCode = json_encode($content);
    file_put_contents($file, $jsonCode);
  }
  
}