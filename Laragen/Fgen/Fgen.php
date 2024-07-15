<?php
namespace Laragen\Fgen;

class Fgen
{
  public static function getFunctionGenObjectFactory(array $funcArgsValidateds): Fgen
  {
    $function = array_shift($funcArgsValidateds);
    $argumentsTemp = array_shift($funcArgsValidateds);
    $functionsClass = get_class_methods(new Fgen());//nativo do php.

    $f = $function.'f';

    if(!in_array($f, $functionsClass)){
      //Quando há uma função mas está errada:
      $argumentsTemp = ['Function "'.$function.'" not found.'];
      $f = 'helpf';
    }

    return self::$f($argumentsTemp);
  }

  private static function helpf(array $argumentsTemp): Fgen
  {
    return new Help($argumentsTemp);
  }

  private static function crudf(array $argumentsTemp): Fgen
  {
    return new Crud($argumentsTemp);
  }

}