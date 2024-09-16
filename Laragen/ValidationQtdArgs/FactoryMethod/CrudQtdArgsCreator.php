<?php
namespace Laragen\ValidationQtdArgs\FactoryMethod;

use Laragen\ValidationQtdArgs\Product\QtdArgs;
use Laragen\ValidationQtdArgs\Product\CrudQtdArgs;

class CrudQtdArgsCreator extends QtdArgsCreator
{
  public static function factory():QtdArgs
  {
    return new CrudQtdArgs();
  }
}  
