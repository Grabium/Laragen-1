<?php
namespace Laragen\Entity;

use Laragen\Views\Question;
use Laragen\SystemPart\Migration;
use Laragen\SystemPart\Model;

class Entity
{
  //entity
  public string       $userInput = '';
  public string            $name = '';
  //table
  public string       $tableName = '';
  public array          $columns = [];
  public array   $imutableColumn = ['id', 'created_at'];
  public array         $fillable = [];
  public array           $hidden = [];
  public string   $nameMigration = '';
  public string  $localMigration = '';
  //model
  public string      $localModel = '';
  //controller
  public string|null   $subdirectoryController = '';
  public string               $localController = '';
  public string           $nameSpaceController = '';
  public string     $nameSpaceControllerQualif = '';
  
  
  public function setName(string $userInput)
  {
    $this->userInput = $userInput;
    $this->name = $this->userInput;
    $this->name = self::formatName($this->name);
    $question   = $GLOBALS['lang']['l1005'].$this->name.'.'.PHP_EOL.$GLOBALS['lang']['l1006'];
    $this->name = ($name = Question::oneNameOrEnter($question)) ? $name : $this->name;
    $this->name = self::formatName($this->name);
  }

  private static function formatName(string $name): string
  {
    $name = ucwords($name);//captula todas palavras
    return str_replace(' ', '', $name);//retira espaços
  }

  
  
}