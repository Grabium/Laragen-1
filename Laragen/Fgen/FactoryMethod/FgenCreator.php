<?php
namespace Laragen\Fgen\FactoryMethod;

use Laragen\Fgen\Product\Fgen;
use Laragen\Fgen\FactoryMethod\CrudCreator;
use Laragen\App\File;

abstract class FgenCreator
{
  abstract static public function factory(array $argumentsTemp):Fgen;

  public static function callFactory(array $funcArgsValidateds):Fgen
  {
    $creator = ucfirst($funcArgsValidateds['function']);
      $creator = 'Laragen\\Fgen\\FactoryMethod\\'.$creator.'Creator';


    if(!File::classExist($creator)){// no lugar do try-catch
      $creator = 'Laragen\\Fgen\\FactoryMethod\\HelpCreator';
    }

    return $creator::factory($funcArgsValidateds['argumentsTemp']);
  }
}