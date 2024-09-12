<?php
namespace Laragen\Fgen\FactoryMethod;

use Laragen\Fgen\Product\Fgen;
use Laragen\Fgen\FactoryMethod\CrudCreator;

abstract class FgenCreator
{
  abstract public static function factory(array $argumentsTemp):Fgen;

  public static function callFactory(array $funcArgsValidateds):Fgen
  {
    $function = ucfirst($funcArgsValidateds['function']);
    $function = 'Laragen\\Fgen\\FactoryMethod\\'.$function.'Creator';
    return $function::factory($funcArgsValidateds['argumentsTemp']);//Fgen
  }

  
}