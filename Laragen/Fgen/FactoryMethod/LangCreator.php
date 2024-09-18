<?php
namespace Laragen\Fgen\FactoryMethod;

use Laragen\Fgen\Product\Fgen;
use Laragen\Fgen\Product\Lang;

class LangCreator extends FgenCreator
{
  public static function factory(array $argumentsTemp):Fgen
  {
    return new Lang($argumentsTemp);
  }
}