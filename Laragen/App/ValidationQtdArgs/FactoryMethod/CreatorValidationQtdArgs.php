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
    $factory = end($r);
    $factory = 'Laragen\\App\\ValidationQtdArgs\\FactoryMethod\\'.$factory.'FactoryValidationQtdArgs';
    return $factory::factory();
  }

    
  
}