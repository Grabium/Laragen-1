<?php
namespace Laragen\SystemPart\Migration;

use Laragen\Views\Question;
use Laragen\Entity\Entity;

class Column
{
  private Entity $entity;
  
  public function __construct(Entity $entity)
  {
    $this->entity = $entity;
    unset($entity);
  }
  
  public function setColumns()
  {
    $this->entity->columns = [['type' => 'unsignedBigInteger', 'name' => 'id']];
    print 'Put the columns names. Not is needed put \'ID\'.'.PHP_EOL;
    while(true){
      $question = 'Set a name column or press [ENTER] for skip: ';
      $name = Question::oneNameOrEnter($question);
      $name = strtolower($name);
      $name = str_replace(['\\',' ', '\/'], '_', $name);
      print PHP_EOL;
      if(($name != null )&&($name != '')){
        $tp = (($name == 'email')||($name == 'e-mail'))? 'email':'string';
        $tp = ($name == 'old')? 'integer': $tp ;
        $this->entity->columns[] = ['type' => $tp, 'name' => $name];
        print 'Next column:'.PHP_EOL;
      }else{
        print 'Columns presets.'.PHP_EOL;
        print 'For default, is writed like STRING on doc migrate. You can customize this after this and before migrate.'.PHP_EOL;
        break;
      }
    }
    $this->entity->columns[] = ['type' => 'timestamp', 'name' => 'created_at'];
    $this->showColumns($this->entity->columns);
    $this->rechangeColumns();
  }

  public function showColumns(array $columns)
  {
    print 'Show columns:'.PHP_EOL.PHP_EOL;
    foreach($columns as $key => $item){
      print $key.' - '.$item['type'].'('.$item['name'].')'.PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
  }

  public function rechangeColumns()
  {
    $question = 'Change a choice: '.PHP_EOL.'Reset[1] Retype[2] Confrim[enter]';
    $ci = Question::choiceInput([$question , '1', '2']);
    //return Question::choiceInput([$question , '1', '2']);//os if eram fora
    if($ci == 1){
      $this->setColumns();
    }elseif($ci == 2){
      $this->setTypeColumns();
    }
  }

  public function setTypeColumns()
  {
    foreach($this->entity->columns as $key => $item){//item=>[tipo, nome]
      
      if(in_array($item['name'], $this->entity->imutableColumn)){
        continue;
      }

      $question = 'Rechange type of this column?'.PHP_EOL.'Column: '.$key.' -> '.$item['type'].'('.$item['name'].')'.PHP_EOL;
      $newType = ($newType = Question::oneNameOrEnter($question)) ? $newType : $item['type'];
      $this->entity->columns[$key] = ['type' => $newType, 'name' => $item['name']];
      print PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
    //return $columns;
    $this->showColumns($this->entity->columns);
    $this->rechangeColumns();
  }

  
}