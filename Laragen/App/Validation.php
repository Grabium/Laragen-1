<?php
namespace Laragen\App;

use Laragen\Fgen\Product\Fgen;
use Laragen\App\ValidationQtdArgs\FactoryMethod\QtdArgsCreator;

class Validation
{
  public static function callHelpOrNot(array $argv): array
  {
    $validatedsArguments = ['function' => '', 'argumentsTemp' => []];
    if(count($argv) <= 1 ){//php gen
      $validatedsArguments['function'] = 'help';
      $validatedsArguments['argumentsTemp'] = ['You given 0 arguments'];
      return $validatedsArguments;
    }
    foreach($argv as $key => $item){
      if($key == 0){continue;}//0=gen.php 1=função.
      if($key == 1){$validatedsArguments['function'] = $item;continue;}
        $validatedsArguments['argumentsTemp'][] = $item;
    }

    return $validatedsArguments;
  }

  public static function verifyQtdArgsAccordingFunction(Fgen $fgen)
  {
    $validator = QtdArgsCreator::callFactory($fgen);//object - ValidationQtdArgs
    //var_dump($validator);
    //print "chegou em validation 2";die();
    $validator->validateQtdArgs($fgen->argumentsTemp);
  }

}