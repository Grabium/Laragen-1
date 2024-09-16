<?php
namespace Laragen\App;

class Json
{
  public static function getJson(string $file):array
  {
    $jsonFile = file_get_contents($file);
    $arrayFileContent = json_decode($jsonFile, true);
    return $arrayFileContent;
  }
}