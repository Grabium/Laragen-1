<?php
namespace Laragen\SystemPart;

use Laragen\SystemPart\Migration\Migration;
use Laragen\SystemPart\Migration\Column;
use Laragen\Entity\Entity;
use Laragen\App\Code;



class MigrationCrud
{
  private Entity $entity;
  private Migration $migration;
  
  public function createTable(Entity $entity)
  {
    $this->entity = $entity;
    $this->migration = new Migration($this->entity);
    
    $this->entity->tableName = $this->migration->formatName($this->entity->userInput.'s');
    $this->migration->confirmTableName('Table: '.$this->entity->tableName.'.'.PHP_EOL.'Press [ENTER] to continue or type to rename the name of table:');
    $this->setColumns();
    $exitLine = Code::runCode('php artisan make:migration create_'.$this->entity->tableName.'_table');
    $this->migration->setLocalMigrate($exitLine);
    $this->migration->replacement();
  }

  //recursividade indireta
  private function setColumns()
  {
    $this->entity->columns = Column::setColumns();
    $this->showColumns();
  }

  private function showColumns()
  {
    Column::showColumns($this->entity->columns);
    $this->rechangeColumns();
  }

  private function rechangeColumns()
  {
    $ci = Column::rechangeColumns();
    if($ci == 1){
      $this->setColumns();
    }elseif($ci == 2){
      $this->setTypeColumns();
    }
  }

  private function setTypeColumns()
  {
    $this->entity->columns = Column::setTypeColumns($this->entity->columns, $this->entity->imutableColumn);
    $this->showColumns();
  }

  
}