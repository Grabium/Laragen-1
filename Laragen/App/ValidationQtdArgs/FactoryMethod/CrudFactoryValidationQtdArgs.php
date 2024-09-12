<?php
namespace Laragen\App\ValidationQtdArgs\FactoryMethod;

use Laragen\App\ValidationQtdArgs\ValidationQtdArgs;
use Laragen\App\ValidationQtdArgs\CrudValidationQtdArgs;

class CrudFactoryValidationQtdArgs extends CreatorValidationQtdArgs
{
  public static function factory():ValidationQtdArgs
  {
    return new CrudValidationQtdArgs();
  }
}  
