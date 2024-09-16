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
  
  public function formactName(string|null $tableName)
  {
    if(($tableName == null)||($tableName == '')){
      $tableName = $this->entity->userInput.'s';
    }
    
    $tableName = strtolower($tableName);//low-case em todas palavras.
    $this->entity->tableName = str_replace(['\\',' ', '\/', '-', '.'], '_', $tableName);//esaços por underline.
  }

  public function confirmTableName()
  {
    $question = 'Table: '.$this->entity->tableName.'.'.PHP_EOL.'Press [ENTER] to continue or type to rename the name of table:';
    $this->entity->tableName = ($name = Question::oneNameOrEnter($question)) ? $name : $this->entity->tableName;
    $this->formactName($this->entity->tableName);
  }

  //$exitLine is return of Code::runCode in facade.
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
    $arrData = ['flag'      => 'createMigrationVariables',
                'localFile' => $this->entity->localMigration, 
                'data'      => $this->entity->columns];
    
    $success = (new Template($arrData))->overrideFile();//string
    if($success == false){
      exit('Not make migrate corretlly');
    }
    
    print 'Migration ok!'.PHP_EOL;
  }
  
}