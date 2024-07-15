<?php
namespace Laragen\Entity;

use Laragen\Views\Question;
use Laragen\SystemPart\Migration;

class Entity
{
  private string $userInput = '';
  private string      $name = '';
  
  public function __construct(string $userInput)
  {
    $this->userInput = $userInput;
    $this->name = $this->userInput;
  }

  public function confirmName()
  {
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

  public function makeMigration()
  {
    $this->migration = new Migration($this->userInput);
    $this->migration->createTable();
  }
  
}