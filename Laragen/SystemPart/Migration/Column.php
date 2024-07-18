<?php
namespace Laragen\SystemPart\Migration;

use Laragen\Views\Question;

class Column
{
  public static function setColumns(): array
  {
    $columns = [['type' => 'unsignedBigInteger', 'name' => 'id']];
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
        $columns[] = ['type' => $tp, 'name' => $name];
        print 'Next column:'.PHP_EOL;
      }else{
        print 'Columns presets.'.PHP_EOL;
        print 'For default, is writed like STRING on doc migrate. You can customize this after this and before migrate.'.PHP_EOL;
        break;
      }
    }
    $columns[] = ['type' => 'timestamp', 'name' => 'created_at'];
    return $columns;
  }

  public static function showColumns(array $columns)
  {
    print 'Show columns:'.PHP_EOL.PHP_EOL;
    foreach($columns as $key => $item){
      print $key.' - '.$item['type'].'('.$item['name'].')'.PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
  }

  public static function rechangeColumns(): int | NULL
  {
    $question = 'Change a choice: '.PHP_EOL.'Reset[1] Retype[2] Confrim[enter]';
    return Question::choiceInput([$question , '1', '2']);
  }

  public static function setTypeColumns(array $columns, array $imutableColumn): array
  {
    foreach($columns as $key => $item){//item=>[tipo, nome]
      
      if(in_array($item['name'], $imutableColumn)){
        continue;
      }

      $question = 'Rechange type of this column?'.PHP_EOL.'Column: '.$key.' -> '.$item['type'].'('.$item['name'].')'.PHP_EOL;
      $newType = ($newType = Question::oneNameOrEnter($question)) ? $newType : $item['type'];
      $columns[$key] = ['type' => $newType, 'name' => $item['name']];
      print PHP_EOL;
    }
    print PHP_EOL.PHP_EOL;
    
    return $columns;
  }

  
}