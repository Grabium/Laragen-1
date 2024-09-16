<?php
namespace Laragen\SystemPart\Migration;

//use Laragen\SystemPart\Migration\Migration;
//use Laragen\SystemPart\Migration\Column;
use Laragen\Entity\Entity;
use Laragen\App\Code;



class FacadeMigration
{
  private Entity $entity;
  private Migration $migration;
  
  public function createTable(Entity $entity)
  {
    $this->entity    = $entity;
    $this->migration = new Migration($this->entity);
    $this->columnObj = new Column($this->entity);
    
    $this->migration->formactName(null);
    $this->migration->confirmTableName();
    $this->columnObj->setColumns();
    $exitLine = Code::runCode('php artisan make:migration create_'.$this->entity->tableName.'_table');
    $this->migration->setLocalMigrate($exitLine);
    $this->migration->replacement();
  }

  
}