<?php
namespace Laragen\Fgen\FactoryMethod;

use Laragen\Fgen\Product\Fgen;
use Laragen\Fgen\Product\Crud;

class CrudCreator extends FgenCreator
{
  public static function factory(array $argumentsTemp):Fgen
  {
    return new Crud($argumentsTemp);
  }
}