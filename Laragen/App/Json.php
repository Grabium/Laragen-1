<?php
namespace Laragen\App;

class Json
{
  public static function getJson(string $file):array
  {
    if(!file_exists($file)){
      exit('File: "'.$file.'" Does not exist at: '.__CLASS__.' - Line: '.__LINE__);
    }
    
    $jsonFile = file_get_contents($file);
    
    if(!$arrayFileContent = json_decode($jsonFile, true)){
      print $jsonFile.PHP_EOL;
      exit('Verify formact or content of file: '.realpath($file).PHP_EOL);
    }
    
    return $arrayFileContent;
  }

  public static function setJson(string $file, array $content)
  {
    $jsonCode = json_encode($content);
    file_put_contents($file, $jsonCode);
  }
  
}