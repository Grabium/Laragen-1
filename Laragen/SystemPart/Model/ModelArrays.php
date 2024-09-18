<?php
namespace Laragen\SystemPart\Model;

use Laragen\App\Code;
use Laragen\Entity\Entity;
use Laragen\Views\Question;

class ModelArrays
{
  private Entity $entity;
  
  public function __construct(Entity $entity)
  {
    $this->entity = $entity;
  }
  
  public function setFillable()
  {
    print PHP_EOL.PHP_EOL.$GLOBALS['lang']['l1019'].'$fillable ? = [';
    $this->entity->fillable = [];
    foreach($this->entity->columns as $column){
      if(in_array($column['name'], $this->entity->imutableColumn)){continue;}
      $this->entity->fillable[] = $column['name'];
      print $column['name'].', ';
    }
    print ']'.PHP_EOL;
    $question = $GLOBALS['lang']['l1020'].'"'.$this->entity->name.'->fillable"'.$GLOBALS['lang']['l1021'];
    $cols = ($cols = Question::oneNameOrEnter($question)) ? $cols : '';
    if($cols != ''){
      $arrcols = explode(' ', $cols);
      $this->excludeOfFillable($arrcols);
    }
  
  }
  
  public function excludeOfFillable(array $arrcols)
  {
    foreach($arrcols as $col){
      if(!in_array($col, $this->entity->fillable)){
        print '"'.$col.'"'.$GLOBALS['lang']['l1022'].$this->entity->name.'->fillable".'.$GLOBALS['lang']['l1023'];
        $this->setFillable();
        break;
      }
      $pos = array_search($col, $this->entity->fillable);
      $exc = array_splice($this->entity->fillable, $pos, 1);//retorna array com excluídos. Nesse caso apenas um por laço.
      print $GLOBALS['lang']['l1024'].'"'.$exc[0].'"'.$GLOBALS['lang']['l1025'].'"'.$this->entity->name.'->fillable".'.PHP_EOL;
    }
  }

  public function setHidden()
  {
    print PHP_EOL.PHP_EOL.'$hidden = []; '.PHP_EOL;
    print '$fillable = [';
    $this->entity->hidden = [];
    foreach($this->entity->fillable as $col){
      print $col.', ';
    }
    print ']'.PHP_EOL;
    $question = $GLOBALS['lang']['l1026'].' $fillable'. $GLOBALS['lang']['l1027'].'"'.$this->entity->name.'->hidden"'.$GLOBALS['lang']['l1028'];
    $cols = ($cols = Question::oneNameOrEnter($question)) ? $cols : '';
    if($cols != ''){
      $arrcols = explode(' ', $cols);
      $this->includeOnHidden($arrcols);
    }
  }

  public function includeOnHidden(array $arrcols)
  {
    foreach($arrcols as $col){
      if(!in_array($col, $this->entity->fillable)){
        print '"'.$col.'" Isn`t '.$this->entity->name.'->fillable". Let´s try again.'.PHP_EOL;
        $this->setHidden();
        break;
      }
      array_push($this->entity->hidden, $col,);
      print $GLOBALS['lang']['l1029'].'"'.$col.'"'.$GLOBALS['lang']['l1030'].$this->entity->name.'->hidden".'.PHP_EOL.PHP_EOL;
    }
  }
}