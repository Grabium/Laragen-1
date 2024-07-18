<?php
namespace Laragen\Fgen;

use Laragen\Entity\Entity;
use Laragen\SystemPart\Migration\FacadeMigration;
use Laragen\SystemPart\Model\FacadeModel;
//use Laragen\SystemPart\;

class Crud extends Fgen
{
  private          Entity $entity;
  private FacadeMigration $migration;
  private     FacadeModel $model;
  public            array $argumentsTemp = [];
  
  public function __construct(array $argumentsTemp)
  {
    $this->argumentsTemp = $argumentsTemp;
    //prototype
    $this->entity    = new Entity();
    $this->migration = new FacadeMigration();
    $this->model     = new FacadeModel();
    
  }

  public function run()
  {    
    $this->entity->setName(array_shift($this->argumentsTemp));
    $this->migration->createTable($this->entity);
    $this->model->makeModel($this->entity);
    //print_r($this);
  }


}