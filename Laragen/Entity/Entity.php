<?php
namespace Laragen\Entity;

use Laragen\Views\Question;
use Laragen\SystemPart\Migration;
use Laragen\SystemPart\Model;

class Entity
{
  public string      $userInput = '';
  public string           $name = '';
  public array  $imutableColumn = ['id', 'created_at'];
  public string $localMigration = '';
  public array         $columns = [];
  public array        $fillable = [];
  public array          $hidden = [];
  public string  $nameMigration = '';
  public string      $tableName = '';
  
  public function setName(string $userInput)
  {
    $this->userInput = $userInput;
    $this->name = $this->userInput;
    $this->name = $this->formatName($this->name);
    $question = 'Entity: '.$this->name.'.'.PHP_EOL.'Press [ENTER] to continue or type to rename entity:';
    $this->name = ($name = Question::oneNameOrEnter($question)) ? $name : $this->name;
    $this->name = $this->formatName($this->name);
  }

  private function formatName(string $name): string
  {
    $name = ucwords($name);//captula todas palavras
    return str_replace(' ', '', $name);//retira espaços
  }

  
  
}