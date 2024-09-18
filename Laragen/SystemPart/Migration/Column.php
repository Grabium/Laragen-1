<?php
namespace Laragen\SystemPart\Migration;

use Laragen\Views\Question;
use Laragen\Entity\Entity;
use Laragen\App\Json;

class Column
{
  private Entity $entity;
  private array  $patternType = [];//buscar do json
  private array  $lang        = [];//recebe global
  
  public function __construct(Entity $entity)
  {
    global $lang;
    $this->lang = $lang;
    $this->entity = $entity;
    $this->patternType = Json::getJson(__DIR__.'/patternType.json');
    unset($entity);
  }
  
  public function setColumns()
  {
    $this->entity->columns = [['type' => 'unsignedBigInteger', 'name' => 'id']];
    print $this->lang['l1008'];
    
    while(true){
      $question = $this->lang['l1009'];
      $name = Question::oneNameOrEnter($question);
      
      
      if($name == null){
        print $this->lang['l1010'];
        break;
        
      }else{
        $name = strtolower($name);
        $name = str_replace(['\\',' ', '\/'], '_', $name);
        print PHP_EOL;
        $type = (array_key_exists($name, $this->patternType)) ? $this->patternType[$name] : 'string';
        $this->entity->columns[] = ['type' => $type, 'name' => $name];
        print $this->lang['l1011'];
      }
    }
    $this->entity->columns[] = ['type' => 'timestamp', 'name' => 'created_at'];
    $this->showColumns($this->entity->columns);
    $this->rechangeColumns();
  }

  

  public function showColumns(array $columns)
  {
    print $this->lang['l1012'];
    foreach($columns as $key => $item){
      print $key.' - '.$item['type'].'('.$item['name'].')'.PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
  }

  public function rechangeColumns()
  {
    $question = $this->lang['l1013'];
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

      $question = $this->lang['l1014'].$key.' -> '.$item['type'].'('.$item['name'].')'.PHP_EOL;
      $newType = ($newType = Question::oneNameOrEnter($question)) ? $newType : $item['type'];
      $this->entity->columns[$key] = ['type' => $newType, 'name' => $item['name']];
      print PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
    $this->showColumns($this->entity->columns);
    $this->rechangeColumns();
  }

  
}