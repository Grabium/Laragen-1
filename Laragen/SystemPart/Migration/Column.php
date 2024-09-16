<?php
namespace Laragen\SystemPart\Migration;

use Laragen\Views\Question;
use Laragen\Entity\Entity;
use Laragen\App\Json;

class Column
{
  private Entity $entity;
  private array  $patternType = [];//buscar do json
  
  public function __construct(Entity $entity)
  {
    $this->entity = $entity;
    $this->patternType = Json::getJson(__DIR__.'/../../App/config/patternType.json');
    unset($entity);
  }
  
  public function setColumns()
  {
    $this->entity->columns = [['type' => 'unsignedBigInteger', 'name' => 'id']];
    print 'Put the columns names. Not is needed put \'ID\'.'.PHP_EOL;
    
    while(true){
      $question = 'Set a name column or press [ENTER] for skip: ';
      $name = Question::oneNameOrEnter($question);
      
      
      if($name == null){
        print 'Columns presets.'.PHP_EOL;
        print 'For default, is writed like STRING on doc migrate. You can customize this after this and before migrate.'.PHP_EOL;
        break;
        
      }else{
        $name = strtolower($name);
        $name = str_replace(['\\',' ', '\/'], '_', $name);
        print PHP_EOL;
        $type = (array_key_exists($name, $this->patternType)) ? $this->patternType[$name] : 'string';
        $this->entity->columns[] = ['type' => $type, 'name' => $name];
        print 'Next column:'.PHP_EOL;
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
    $this->showColumns($this->entity->columns);
    $this->rechangeColumns();
  }

  
}