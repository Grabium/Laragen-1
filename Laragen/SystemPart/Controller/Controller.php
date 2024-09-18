<?php

namespace Laragen\SystemPart\Controller;

use Laragen\Entity\Entity;
use Laragen\Views\Question;
use Laragen\Template\Template;

class Controller
{
  private Entity $entity;
  
  public function __construct(Entity $entity)
  {
    $this->entity = $entity;
  }

  public function setSubdirectory()
  {
    $question = $GLOBALS['lang']['l1007'];
    $subdirectoryController = ($subdirectoryController = Question::oneNameOrEnter($question)) ? $subdirectoryController : null ;
    $this->entity->subdirectoryController = SubDirController::validateSubDir($subdirectoryController);
  }

  public function setCreatorCode()
  {
    $c = 'php artisan make:controller ';
    if($this->entity->subdirectoryController != ''){
      return $c.$this->entity->subdirectoryController.'/'.$this->entity->name.'Controller';
    }else{
      return $c.$this->entity->name.'Controller';
    }
  }

  public function setLocalController()
  {
    if(!$this->entity->subdirectoryController){
      $this->entity->localController = realpath(__DIR__.'/../../../app/Http/Controllers/'.$this->entity->name.'Controller.php');
    }else{
      $this->entity->localController = realpath(__DIR__.'/../../../app/Http/Controllers/'.$this->entity->subdirectoryController.'/'.$this->entity->name.'Controller.php');
    }
    print $GLOBALS['lang']['l1007.1'];//realpath verifica se o arquivo já existees
    $this->setNameSpace();
  }

  public function setNameSpace()
  {
    $nameSC = 'App\Http\Controllers';
    if(!$this->entity->subdirectoryController){
      $this->entity->nameSpaceController = $nameSC;
      $this->entity->nameSpaceControllerQualif = $this->entity->nameSpaceController.'\\'.$this->entity->name;
      return;
    }
    $subdir = ucfirst($this->entity->subdirectoryController);
    $sd = str_replace('/', '\\', $subdir);
    $this->entity->nameSpaceController = $nameSC.'\\'.$sd ;
    $this->entity->nameSpaceControllerQualif = $this->entity->nameSpaceController.'\\'.$this->entity->name;
  }

  

  public function crudReplacement()
  {
    $arrData = ['flag' => 'createControllerVariables',
      'localFile' => $this->entity->localController, 
      'data' => [$this->entity]
    ];
    $success = (new Template($arrData))->overrideFile();//string
    if(!$success){
      exit('Controller overwrite fail'.PHP_EOL);
    }
    print $GLOBALS['lang']['l1007.2'];
    
  }
  
}