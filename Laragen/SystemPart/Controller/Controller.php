<?php

namespace Laragen\SystemPart\Controller;

use Laragen\Entity\Entity;
use Laragen\Views\Question;

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
  public function setSubdirectory(): string
  {
    $question = 'Type the name of subdirectory for controller Or Press [ENTER] to skip'.PHP_EOL.'Look: New/Sub/Directory'.PHP_EOL.'Look: New Sub Directory';
    $subdirectoryController = ($subdirectoryController = Question::oneNameOrEnter($question)) ? $subdirectoryController : ' ';
    $subdirectoryController = SubDirController::validateSubDir($subdirectoryController);
    $this->setLocalController($subdirectoryController);
    return $subdirectoryController;
  }

  public function setLocalController($subdirectoryController)
  {
    $this->entity->localController = realpath(__DIR__.'/../../../app/Http/Controllers').'/';
    $this->entity->localController .= $subdirectoryController.$this->entity->name.'.php';
  }

  public function fileExists()
  {
    if(!file_exists($this->entity->localController)){
      exit('Controller: '.$this->entity->localController.' Not found!');
    }
    print 'Controller ok!'.PHP_EOL;
  }
  
}