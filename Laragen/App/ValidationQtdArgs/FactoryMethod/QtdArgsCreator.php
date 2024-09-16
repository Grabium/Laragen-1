<?php

namespace Laragen\App\ValidationQtdArgs\FactoryMethod;

use Laragen\App\ValidationQtdArgs\Product\QtdArgs;
use Laragen\App\ValidationQtdArgs\FactoryMethod\CrudQtdArgsCreator;

abstract class QtdArgsCreator
{
  abstract public static function factory():QtdArgs;
  
  public static function callFactory($fgen):QtdArgs
  {
    $qtdArgs = explode('\\', get_class($fgen));
    $qtdArgs = end($qtdArgs);
    $qtdArgs = 'Laragen\\App\\ValidationQtdArgs\\FactoryMethod\\'.$qtdArgs.'QtdArgsCreator';

    return $qtdArgs::factory();
  }
}