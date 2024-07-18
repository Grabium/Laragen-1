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
    print PHP_EOL.PHP_EOL.'Exclude of $fillable attribute? = [';
    $this->entity->fillable = [];
    foreach($this->entity->columns as $column){
      if(in_array($column['name'], $this->entity->imutableColumn)){continue;}
      $this->entity->fillable[] = $column['name'];
      print $column['name'].' ';
    }
    print ']'.PHP_EOL;
    $question = 'Exclude an attribute above of "'.$this->entity->name.'->fillable" typing it and separates with space.'.PHP_EOL.' Or press [ENTER] for continue:';
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
        print '"'.$col.'" Isn`t '.$this->entity->name.'->fillable". Let´s try again.'.PHP_EOL;
        $this->setFillable();
        break;
      }
      $pos = array_search($col, $this->entity->fillable);
      $exc = array_splice($this->entity->fillable, $pos, 1);//retorna array com excluídos. Nesse caso apenas um por laço.
      print 'Attribute "'.$exc[0].'" has removed of '.$this->entity->name.'->fillable sucessfuly".'.PHP_EOL;
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
    $question = 'Include any $fillable on "'.$this->entity->name.'->hidden" typing it and separates with space.'.PHP_EOL.' Or press [ENTER] for continue:';
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
      print 'Attribute "'.$col.'" has include on '.$this->entity->name.'->hidden sucessfuly".'.PHP_EOL.PHP_EOL;
    }
  }
}