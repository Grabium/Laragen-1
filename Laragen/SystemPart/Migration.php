<?php
namespace Laragen\SystemPart;

use Laragen\Views\Question;
use Laragen\Template\Template;
use Laragen\App\Code;
use Laragen\Views\ColumnEntView;
use Laragen\Entity\Entity;

class Migration
{

  protected Entity $entity;

  
  protected function confirmTableName(string $question)
  {
    $this->entity->tableName = ($name = Question::oneNameOrEnter($question)) ? $name : $this->entity->tableName;
    $this->entity->tableName = $this->formatName($this->entity->tableName);
  }

  protected function formatName(string $tempTableName): string
  {
    $tempTableName = strtolower($tempTableName);//low-case em todas palavras.
    return str_replace(['\\',' ', '\/', '-', '.'], '_', $tempTableName);//esaços por underline.
  }

  protected function setColumns()
  {
    $this->entity->columns = ColumnEntView::setColumns();
    $this->showColumns();
  }

  private function showColumns()
  {
    ColumnEntView::showColumns($this->entity->columns);
    $this->rechangeColumns();
  }

  private function rechangeColumns()
  {
    $ci = ColumnEntView::rechangeColumns();
    if($ci == 1){
      $this->setColumns();
    }elseif($ci == 2){
      $this->setTypeColumns();
    }
  }

  private function setTypeColumns()
  {
    $this->entity->columns = ColumnEntView::setTypeColumns($this->entity->columns, $this->entity->imutableColumn);
    $this->showColumns();
  }

  protected function setLocalMigrate(string $exitLine)
  { 
    $bef = (strpos($exitLine, '[')+1);
    $aft = (strpos($exitLine, ']'));
    $end = ($aft - $bef);
    $this->entity->nameMigration =  substr($exitLine, $bef, $end).'.php';
    $this->entity->localMigration = realpath(__DIR__.'/../../database/migrations/'.$this->entity->nameMigration);
  }
  
  protected function replacement()
  {
    $arrData = ['tag' => 'crudMigration',
      'localFile' => $this->entity->localMigration, 
      'data' => $this->entity->columns];
    //var_dump($arrData);die();
    $ifOverriding = (new Template($arrData))->overrideFile();//string
    if($ifOverriding == false){exit('Not make migrate corretlly');}
    print 'Migrate ok!'.PHP_EOL;
  }
  
}