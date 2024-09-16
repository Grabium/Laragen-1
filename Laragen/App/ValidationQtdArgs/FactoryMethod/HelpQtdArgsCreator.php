<?php
namespace Laragen\App\ValidationQtdArgs\FactoryMethod;

use Laragen\App\ValidationQtdArgs\Product\QtdArgs;
use Laragen\App\ValidationQtdArgs\Product\HelpQtdArgs;

class HelpQtdArgsCreator extends QtdArgsCreator
{
  public static function factory():QtdArgs
  {
    return new HelpQtdArgs();
  }
}