<?php
namespace Laragen\App\ValidationQtdArgs\FactoryMethod;


use Laragen\App\ValidationQtdArgs\ValidationQtdArgs;
use Laragen\App\ValidationQtdArgs\ValidationQtdArgs\CrudValidationQtdArgs;


abstract class CreatorValidationQtdArgs
{
  abstract public static function factory():ValidationQtdArgs;
  
  public static function callFactory($fgen):ValidationQtdArgs
  {
    $r = explode('\\', get_class($fgen));
    $f = end($r);
    $f = 'Laragen\\App\\ValidationQtdArgs\\FactoryMethod\\'.$f.'FactoryValidationQtdArgs';
    return $f::factory();
  }

    
  
}