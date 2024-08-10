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
/* Vai para rotas.
  //perguntar se é uma api e configurar entity->route : api|web
  public function is_api()
  {
    $question = 'Press [ENTER] for API routes, or type [web|w] for WEB routes';
    $res = ($res = Question::oneNameOrEnter($question)) ? $res : false;
    $res = strtolower($res);
    if($res == false){
      //programr api
      $this->entity->route = 'api';
    }elseif(($res == 'w')||($res == 'web')){
      //caso web
    }elseif(($res == true )&&(($res != 'web')||($res != 'w'))){
      //case algo foi digitado mas nãofoi web.
    }
  }
*/
  //perguntar se haverá uma subpasta para este controller e qual o nome.
  public function setSubdirectory()
  {
    $question = 'Type the name of subdirectory for controller Or Press [ENTER] to skip'.PHP_EOL.'Look: New/Sub/Directory'.PHP_EOL.'Look: New Sub Directory';
    $subdirectoryController = ($subdirectoryController = Question::oneNameOrEnter($question)) ? $subdirectoryController : null ;
    $this->entity->subdirectoryController = SubDirController::validateSubDir($subdirectoryController);
    //$this->entity->subdirectoryController = $subdirectoryController;
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

  //só deve ser chamado caso o caminho/arquivo já exista.
  public function setLocalController()
  {
    if(!$this->entity->subdirectoryController){
      $this->entity->localController = realpath(__DIR__.'/../../../app/Http/Controllers/'.$this->entity->name.'Controller.php');
    }else{
      $this->entity->localController = realpath(__DIR__.'/../../../app/Http/Controllers/'.$this->entity->subdirectoryController.'/'.$this->entity->name.'Controller.php');
    }
    print 'Controller created!'.PHP_EOL;//realpeth verifica se o arquivo já existees
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
    //recolocar o crud ainda sem nenhuma validação ouqualquer outra proxy.
    $arrData = ['flag' => 'createControllerVariables',
      'localFile' => $this->entity->localController, 
      'data' => [$this->entity]
    ];
    $success = (new Template($arrData))->overrideFile();//string
    if(!$success){
      exit('Controller overwrite fail'.PHP_EOL);
    }
    print 'Controller overwited!'.PHP_EOL;
    
  }
  
}