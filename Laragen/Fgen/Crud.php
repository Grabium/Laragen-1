<?php
namespace Laragen\Fgen;

use Laragen\Entity\Entity;
use Laragen\SystemPart\MigrationCrud;
use Laragen\SystemPart\ModelCrud;
//use Laragen\SystemPart\;

class Crud extends Fgen
{
  private        Entity $entity;
  private MigrationCrud $migration;
  //private     ModelCrud $model;
  public          array $argumentsTemp = [];
  
  public function __construct(array $argumentsTemp)
  {
    $this->argumentsTemp = $argumentsTemp;
    //prototype
    $this->entity    = new Entity();
    $this->migration = new MigrationCrud('migration ok');
    $this->model     = new ModelCrud('model ok tambem');
    
  }

  public function run()
  {    
    $this->entity->setName(array_shift($this->argumentsTemp));
    $this->migration->createTable($this->entity);
    /*
    $this->entity->makeModel();*/
    //print_r($this);
  }


}