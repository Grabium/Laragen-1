<?php
namespace Laragen\Fgen;

use Laragen\Entity\Entity;

class Crud extends Fgen
{
  private Entity $entity;
  public   array $argumentsTemp = [];
  
  public function __construct(array $argumentsTemp)
  {
    $this->argumentsTemp = $argumentsTemp;
    $this->entity = new Entity($this->argumentsTemp[0]);//prototype
  }

  public function run()
  {
    $this->entity->confirmName();
    $this->entity->makeMigration();
    //var_dump($this);
    $this->entity->makeModel();
  }


}