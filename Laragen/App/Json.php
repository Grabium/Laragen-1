<?php
namespace Laragen\App;

class Json
{
  public static function getJson(string $file):array
  {
    if(!file_exists($file)){
      exit($file.' - não existe. - Em '.__CLASS__.' - line: '.__LINE__);
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