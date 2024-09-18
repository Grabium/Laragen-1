<?php
namespace Laragen\ValidationQtdArgs\FactoryMethod;

use Laragen\ValidationQtdArgs\Product\QtdArgs;
use Laragen\ValidationQtdArgs\Product\LangQtdArgs;

class LangQtdArgsCreator extends QtdArgsCreator
{
  public static function factory():QtdArgs
  {
    return new LangQtdArgs();
  }
}