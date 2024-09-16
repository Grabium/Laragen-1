<?php
namespace Laragen\Fgen\Product;

use Laragen\Entity\Entity;
use Laragen\SystemPart\Migration\FacadeMigration;
use Laragen\SystemPart\Model\FacadeModel;
use Laragen\SystemPart\Controller\FacadeController;

class Crud extends Fgen
{
  private           Entity $entity;
  private  FacadeMigration $migrationFacade;
  private      FacadeModel $modelFacade;
  private FacadeController $controllerFacade;
  public             array $argumentsTemp = [];
  
  public function __construct(array $argumentsTemp)
  {
    $this->argumentsTemp    = $argumentsTemp;
    $this->entity           = new Entity();
    $this->migrationFacade  = new FacadeMigration();
    $this->modelFacade      = new FacadeModel();
    $this->controllerFacade = new FacadeController();
    
  }

  public function run()
  {    
    $this->entity->setName(array_shift($this->argumentsTemp));
    $this->migrationFacade->createTable($this->entity);
    $this->modelFacade->makeModel($this->entity);
    $this->controllerFacade->makeController($this->entity);
  }


}