<?php
namespace Laragen\ValidationQtdArgs\FactoryMethod;

use Laragen\ValidationQtdArgs\Product\QtdArgs;
use Laragen\ValidationQtdArgs\Product\HelpQtdArgs;

class HelpQtdArgsCreator extends QtdArgsCreator
{
  public static function factory():QtdArgs
  {
    return new HelpQtdArgs();
  }
}