<?php
namespace Laragen\SystemPart\Model;

use Laragen\App\Code;
use Laragen\Entity\Entity;
use Laragen\Views\Question;
use Laragen\Template\Template;

class Model
{
  public function __construct(Entity $entity)
  {
    $this->entity = $entity;
  }

  public function getLocalModelAndVerify($exitLine)
  {
    $bef = (strpos($exitLine, '[')+1);
    $aft = (strpos($exitLine, ']'));
    $end = ($aft - $bef);
    $loc =  substr($exitLine, $bef, $end);
    if(!$this->entity->localModel = realpath(__DIR__.'/../../../'.$loc)){
     exit('Fail');
    }
  }

  public function replacement()
  {
    //$dif = array_diff();
    $arrData = ['flag' => 'createModelVariables',
      'localFile' => $this->entity->localModel, 
      'data' => [$this->entity]
    ];
    $success = (new Template($arrData))->overrideFile();//string
    if(!$success){
      exit('Model overwrite fail'.PHP_EOL);
    }
    print 'Model ok!'.PHP_EOL;
  }
}