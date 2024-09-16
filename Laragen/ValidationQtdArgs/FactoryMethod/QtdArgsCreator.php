<?php

namespace Laragen\ValidationQtdArgs\FactoryMethod;

use Laragen\ValidationQtdArgs\Product\QtdArgs;
use Laragen\ValidationQtdArgs\FactoryMethod\CrudQtdArgsCreator;

abstract class QtdArgsCreator
{
  abstract public static function factory():QtdArgs;
  
  public static function callFactory($fgen):QtdArgs
  {
    $qtdArgs = explode('\\', get_class($fgen));
    $qtdArgs = end($qtdArgs);
    $qtdArgs = 'Laragen\\ValidationQtdArgs\\FactoryMethod\\'.$qtdArgs.'QtdArgsCreator';

    return $qtdArgs::factory();
  }
}