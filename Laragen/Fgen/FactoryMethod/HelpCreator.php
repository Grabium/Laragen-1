<?php
namespace Laragen\Fgen\FactoryMethod;

use Laragen\Fgen\Product\Fgen;
use Laragen\Fgen\Product\Help;

class HelpCreator extends FgenCreator
{
  public static function factory(array $argumentsTemp):Fgen
  {
    return new Help($argumentsTemp);
  }
}