<?php 
namespace Laragen\SystemPart\Model;

//use Laragen\SystemPart\Model\Model;
//use Laragen\SystemPart\Model\ModelArrays;
use Laragen\Entity\Entity;
use Laragen\App\Code;

class FacadeModel
{
  private Entity      $entity;
  private Model       $model;
  private ModelArrays $modelArrays;
  
  public function makeModel(Entity $entity)
  {
    $this->entity = $entity;
    $this->model = new Model($this->entity);
    $this->modelmodelArrays = new ModelArrays($this->entity);
    
    $this->modelmodelArrays->setFillable();
    $this->modelmodelArrays->setHidden();
    $exitLine = Code::runCode('php artisan make:model '.$this->entity->name);
    $this->model->getLocalModelAndVerify($exitLine);
    $this->model->replacement();
  }
}