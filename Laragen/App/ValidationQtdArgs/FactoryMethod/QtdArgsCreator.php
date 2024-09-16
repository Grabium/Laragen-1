<?php
namespace Laragen\App\ValidationQtdArgs\FactoryMethod;


use Laragen\App\ValidationQtdArgs\Product\QtdArgs;
use Laragen\App\ValidationQtdArgs\FactoryMethod\CrudQtdArgsCreator;


abstract class QtdArgsCreator
{
  abstract public static function factory():QtdArgs;
  
  public static function callFactory($fgen):QtdArgs
  {
    $r = explode('\\', get_class($fgen));
    $factory = end($r);
    $factory = 'Laragen\\App\\ValidationQtdArgs\\FactoryMethod\\'.$factory.'QtdArgsCreator';
    
    try{
      $fgen = $factory::factory();
    }catch(Exception $e){
      $fgen = Laragen\App\ValidationQtdArgs\FactoryMethod\HelpQtdArgsCreator::factory();
    }finally{
      return $fgen;
    }
  }
}