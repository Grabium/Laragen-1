<?php
namespace Laragen\App;

use Laragen\Fgen\Product\Fgen;
use Laragen\ValidationQtdArgs\FactoryMethod\QtdArgsCreator;

class Validation
{
  public static function callHelpOrNot(array $argv): array
  {
    $validatedsArguments = ['function' => '', 'argumentsTemp' => []];

    if(count($argv) >= 2 ){
      if($argv[1] == 'help'){
        $validatedsArguments['argumentsTemp'] = [' '];
      }
    }
    
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
    $validator->validateQtdArgs($fgen->argumentsTemp);
  }

}