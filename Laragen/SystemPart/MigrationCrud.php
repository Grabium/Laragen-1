<?php
namespace Laragen\SystemPart;

use Laragen\Entity\Entity;
use Laragen\App\Code;

class MigrationCrud extends Migration
{
  public function createTable(Entity $entity)
  {
    $this->entity = $entity;
    
    $this->entity->tableName = $this->formatName($this->entity->userInput.'s');
    $this->confirmTableName('Table: '.$this->entity->tableName.'.'.PHP_EOL.'Press [ENTER] to continue or type to rename the name of table:');
    $this->setColumns();
    $exitLine = Code::runCode('php artisan make:migration create_'.$this->entity->tableName.'_table');
    $this->setLocalMigrate($exitLine);
    $this->replacement();
    //var_dump($this);
  }

  
}