<?php

namespace Laragen\SystemPart\Controller;

class SubDirController
{
  public static function validateSubDir(string|null $subdirectoryController): string|null
  {
    if(!$subdirectoryController){
      return null;
    }
    $subdirectoryController = str_replace(['/','\\','-', '_'], ' ', $subdirectoryController);//retira espaços
    $subdirectoryController = ucwords($subdirectoryController);//captula todas palavras
    $subdirectoryController = str_replace(' ', DIRECTORY_SEPARATOR, $subdirectoryController);//retira espaços
    if($subdirectoryController[0] == '/'){
      $subdirectoryController = substr($subdirectoryController, 1);
    }
    if($subdirectoryController[-1] == '/'){
      $subdirectoryController = substr($subdirectoryController, 0, -1);
    }
    
    return $subdirectoryController;
  }
}