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
  public function setSubdirectory(): string
  {
    $question = 'Type the name of subdirectory for controller Or Press [ENTER] to skip'.PHP_EOL.'Look: New/Sub/Directory'.PHP_EOL.'Look: New Sub Directory';
    $subdirectoryController = ($subdirectoryController = Question::oneNameOrEnter($question)) ? $subdirectoryController. : ' ';
    $subdirectoryController = SubDirController::validateSubDir($subdirectoryController);
    $this->entity->subdirectoryController = $subdirectoryController;
    return $this->setLocalController();
  }

  public function setLocalController()
  {
    $this->entity->localController = realpath(__DIR__.'/../../../app/Http/Controllers/'.$this->entity->subdirectoryController.'/'.$this->entity->name.'Controller.php');
    $this->setNameSpace();
    return $subdir;
  }

  public function setNameSpace()
  (
    $subdir = ucfirst($this->entity->subdirectoryController);
    $this->entity->nameSpaceController = str_replace('/', '\\', $subdir);
  )

  public function fileExists()
  {
    if(!file_exists($this->entity->localController)){
      exit('Controller: '.$this->entity->localController.' Not found!');
    }
    print 'Controller created!'.PHP_EOL;
  }

  public function crudReplacement()
  {
    //recolocar o crud ainda sem nenhuma validação ouqualquer outra proxy.
    //$dif = array_diff();
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