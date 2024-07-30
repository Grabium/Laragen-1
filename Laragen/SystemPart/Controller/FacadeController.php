<?php

namespace Laragen\SystemPart\Controller;

use Laragen\Entity\Entity;
use Laragen\App\Code;

class FacadeController
{
  private Entity $entity;
  private Controller $controller;
  
  public function makeController(Entity $entity)
  {
    $this->entity = $entity;  
    $this->controller = new Controller($this->entity);
    $subdirectoryController = $this->controller->setSubdirectory();
    $exitLine = Code::runCode('php artisan make:controller '.$subdirectoryController.$this->entity->name);
    $this->controller->fileExists();
    var_dump($this->controller);

    //perguntar se é uma api e configurar entity->route : api|web - 
    //perguntar se haverá uma subpasta para este controller e qual o nome.
    //perguntar se haverá uma validação na requisição para este crud para setar palavras chave nos endpoints adequados
    //fazer um setCode adequado à entity->route
    //rodar o código
    //verificar o arquivo.
    
  }
}