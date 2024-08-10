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
    //var_dump($subdirectoryController);die();
    $subdirectoryController = ucwords($subdirectoryController);//captula todas palavras
    $subdirectoryController = str_replace(' ', DIRECTORY_SEPARATOR, $subdirectoryController);//retira espaços
    //var_dump($subdirectoryController);
    if($subdirectoryController[0] == '/'){
      $subdirectoryController = substr($subdirectoryController, 1);
    }
    if($subdirectoryController[-1] == '/'){
      $subdirectoryController = substr($subdirectoryController, 0, -1);
    }
    //var_dump($subdirectoryController);die();

    //$subdirectoryController = preg_replace('/[\p{Mn}]/u', '', $subdirectoryController);
    //Transforma caracteres com diacrítico em seus equivalentes sem diacrítico
    //$subdirectoryController = iconv('utf-8', 'ASCII//TRANSLIT', $subdirectoryController);
    
    //var_dump($subdirectoryController);
    return $subdirectoryController;
  }
}