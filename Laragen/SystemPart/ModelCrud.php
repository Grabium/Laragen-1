<?php 
namespace Laragen\SystemPart;

use Laragen\SystemPart\Model\Model;
use Laragen\SystemPart\Model\ModelArrays;
use Laragen\Entity\Entity;
use Laragen\App\Code;

class ModelCrud
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
    //var_dump($this->entity->hidden);
    echo 'finalizou aqui : Laragen/Model.php line 21.';
  }
}