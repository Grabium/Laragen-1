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
    $this->controller->setSubdirectory();
    $exitLine = Code::runCode($this->controller->setCreatorCode());
    $this->controller->setLocalController();
    $this->controller->crudReplacement();
    //var_dump($this->controller);

    //perguntar se é uma api e configurar entity->route : api|web -
    //perguntar se haverá uma validação na requisição para este crud para setar palavras chave nos endpoints adequados

    
  }
}