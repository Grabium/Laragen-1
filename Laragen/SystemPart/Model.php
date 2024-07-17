<?php
namespace Laragen\SystemPart;

use Laragen\App\Code;

class Model
{
  public function __construct(string $name)
  {
    $this->entity = $name;
    $this->model  = $name.'.php';
    //nome_da_tabela, colunas, hidden, fillable...
  }

  public function createModel(array $columns)
  {
    $this->setCode();
    Code::runCode($this->code);
    $this->getLocalModelAndVerify();
    //$this->fillable
    echo 'finalizou aqui : Laragen/Model.php line 21.';
  }

  private function setCode()
  {
    $this->code = 'php artisan make:model '.$this->entity;
  }

  private function getLocalModelAndVerify()
  {
    $this->localModel = realpath(__DIR__.'/../../app/Models/'.$this->model);
    if(!file_exists($this->localModel)){
      exit($this->localModel.' NOT search!');
    }
    print 'Model ok!'.PHP_EOL;
  }

  private function replacement()
  {
    //$dif = array_diff();
    $arrData = ['tag' => 'crudModel','localFile' => $this->localModel, 'data' => [$this->columns, $this->entity]];
    $newFile = (new Template($arrData))->overrideFile();//string
    if(file_put_contents($this->localMigration, $newFile)){
      print 'Migration ok'.PHP_EOL;
    };
  }


   /* public function getFillables()
    {
      $diff = array_diff($protectedColumns, $columns);
      var_dump($diff);die();
      return $diff;
    }*/
}