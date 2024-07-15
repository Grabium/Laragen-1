<?php
namespace Laragen\SystemPart;

use Laragen\Views\Question;
use Laragen\Template\Template;

class Migration
{
  private  array $protectedColumns = ['id', 'created_at'];
  private string        $tableName = '';
  //private string    $tempTableName = '';
  private  array          $columns = [];
  private string             $code = '';
  private string   $localMigration = '';
  private string    $nameMigration = '';
  
  public function __construct(string $tempTableName)
  {
    $this->tableName = $tempTableName;
  }

  public function createTable()
  {
    $this->confirmTableName();
    $this->setColumns();
    $this->setCode('php artisan make:migration create_'.$this->tableName.'_table');
    $exitLine = $this->runCode();
    $this->setLocalMigrate($exitLine);
    $this->replacement();
    //var_dump($this);
  }

  private function confirmTableName()
  {
    $this->tableName = $this->formatName($this->tableName.'s');
    $question = 'Table: '.$this->tableName.'.'.PHP_EOL.'Press [ENTER] to continue or type to rename the name of table:';
    $this->tableName = ($name = Question::oneNameOrEnter($question)) ? $name : $this->tableName;
    $this->tableName = $this->formatName($this->tableName);
  }

  private function formatName(string $tempTableName): string
  {
    $tempTableName = strtolower($tempTableName);//low-case em todas palavras.
    return str_replace(['\\',' ', '\/', '-', '.'], '_', $tempTableName);//esaços por underline.
  }

  private function setColumns()
  {
    $this->columns = [['unsignedBigInteger', 'id']];
    print 'Put the columns names. Not is needed put \'ID\'.'.PHP_EOL;
    $cc = 0;
    while(true){
      $question = 'Set a name column or press [ENTER] for skip: ';
      $name = Question::oneNameOrEnter($question);
      $name = strtolower($name);
      $name = str_replace(['\\',' ', '\/'], '_', $name);
      print PHP_EOL;
      if(($name != null )&&($name != '')){
        $tp = (($name == 'email')||($name == 'e-mail'))? 'email':'string';
        $tp = ($name == 'old')? 'integer': $tp ;
        $this->columns[] = [$tp, $name];//name type
        $cc++;
        print 'Next column:'.PHP_EOL;
      }else{
        print 'Columns presets.'.PHP_EOL;
        print 'For default, is writed like STRING on doc migrate. You can customize this after this and before migrate.'.PHP_EOL;
        break;
      }
    }
    $this->columns[] = ['timestamp', 'created_at'];//name type
    $this->vewColumns();
  }

  private function vewColumns()
  {
    print 'Show columns:'.PHP_EOL.PHP_EOL;
    foreach($this->columns as $key => $item){
      print $key.' - '.$item[0].'('.$item[1].')'.PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
    $this->rechangeColumns();
  }

  private function rechangeColumns()
  {
    $question = 'Change a choice: '.PHP_EOL.'Reset[1] Retype[2] Confrim[enter]';
    $ci = Question::choiceInput([$question , '1', '2']);
    if($ci == 1){
      $this->setColumns();
    }elseif($ci == 2){
      $this->setTypeColumns();
    }
  }

  private function setTypeColumns()
  {
    foreach($this->columns as $key => $item){//item=>[tipo, nome]
      if(in_array($item[1], $this->protectedColumns)){continue;}
      $question = 'Rechange type of this column?'.PHP_EOL.'Column: '.$key.' -> '.$item[0].'('.$item[1].')'.PHP_EOL;
      $newType = ($newType = Question::oneNameOrEnter($question)) ? $newType : $item[0];
      $this->columns[$key] = [$newType, $item[1]];
      
      print PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
    $this->vewColumns();
  }

  private function setCode(string $code)
  {
    $this->code = $code;
  }

  private function runCode(): string
  {
    print 'Processing. Wait a moment...'.PHP_EOL.PHP_EOL;
    $exitLine = shell_exec($this->code);//return shell string 
    print $exitLine.PHP_EOL;
    return $exitLine;
  }

  private function setLocalMigrate(string $exitLine)
  { 
    $bef = (strpos($exitLine, '[')+1);
    $aft = (strpos($exitLine, ']'));
    $end = ($aft - $bef);
    $this->nameMigration =  substr($exitLine, $bef, $end).'.php';
    $this->localMigration = realpath(__DIR__.'/../../database/migrations/'.$this->nameMigration);
  }
  
  private function replacement()
  {
    
    $arrData = ['tag' => 'crudMigration','localFile' => $this->localMigration, 'data' => $this->columns];
    $newFile = (new Template($arrData))->overrideFile();//string
    if(file_put_contents($this->localMigration, $newFile)){
      print 'Migration ok'.PHP_EOL;
    };
  }
}