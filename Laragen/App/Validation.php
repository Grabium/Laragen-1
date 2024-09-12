<?php
namespace Laragen\App;

use Laragen\Fgen\Product\Fgen;
use Laragen\App\ValidationQtdArgs\FactoryMethod\QtdArgsCreator;

class Validation
{
  public static function callHelpOrNot(int $argc, array $argv): array
  {
    $arguments = [];
    if(count($argv) <= 1 ){//garb
      $function = 'help';
      return [$function, ['']];
    }

    foreach($argv as $key => $item){
      if($key == 0){continue;}//0=garb.php 1=função.
      if($key == 1){$function = $item;continue;}
      $arguments[] = $item;
    }

    return ['function' => $function, 'argumentsTemp' => $arguments];
  }

  public static function verifyQtdArgsAccordingFunction(Fgen $fgen)
  {
    $validator = QtdArgsCreator::callFactory($fgen);//object - ValidationQtdArgs
    $validator->validateQtdArgs($fgen->argumentsTemp);
  }

}