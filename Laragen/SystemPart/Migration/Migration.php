<?php
namespace Laragen\SystemPart\Migration;

use Laragen\Views\Question;
use Laragen\Template\Template;
use Laragen\App\Code;
use Laragen\Views\Column;
use Laragen\Entity\Entity;

class Migration
{

  public Entity $entity;

  public function __construct(Entity $entity)
  {
    $this->entity = $entity;
  }
  
  public function confirmTableName(string $question)
  {
    $this->entity->tableName = ($name = Question::oneNameOrEnter($question)) ? $name : $this->entity->tableName;
    $this->entity->tableName = $this->formatName($this->entity->tableName);
  }

  public function formatName(string $tempTableName): string
  {
    $tempTableName = strtolower($tempTableName);//low-case em todas palavras.
    return str_replace(['\\',' ', '\/', '-', '.'], '_', $tempTableName);//esaços por underline.
  }


  //$exitLine is return of Code.
  public function setLocalMigrate(string $exitLine)
  { 
    $bef = (strpos($exitLine, '[')+1);
    $aft = (strpos($exitLine, ']'));
    $end = ($aft - $bef);
    $this->entity->nameMigration =  substr($exitLine, $bef, $end).'.php';
    if(!$this->entity->localMigration = realpath(__DIR__.'/../../../database/migrations/'.$this->entity->nameMigration)){
     exit('fail on setLocalMigration()');
    }
  }
  
  public function replacement()
  {
    $arrData = ['flag' => 'createMigrationVariables',
      'localFile' => $this->entity->localMigration, 
      'data' => $this->entity->columns];
    $success = (new Template($arrData))->overrideFile();//string
    if($success == false){exit('Not make migrate corretlly');}
    print 'Migrate ok!'.PHP_EOL;
  }
  
}