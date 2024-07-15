<?php
namespace Laragen\App;

use Laragen\Fgen\Crud;

class Validate
{
  public static function initialValidation(int $argc, array $argv): array
  {
    $arguments = [];
    if(count($argv) <= 1 ){//garb
      $function = 'help';
      return [$function, ['']];
    }

    foreach($argv as $key => $item){
      if($key == 0){continue;}//0=garb.php 1=função.
      if($key == 1){$function = $item;continue;}
      $arguments[] = $item;
    }

    return [$function, $arguments];
  }

  public static function ifBrokenArgs($object)
  {
    $r = explode('\\', get_class($object));
    $f = lcfirst(end($r));
    self::$f($object);
  }
  
  //faz toda a validação para save mas não altera objeto.
  private static function crud(Crud $save)
  {
    if(count($save->argumentsTemp) != 1){
      exit('Inadequate number of arguments. Please try: php gen help'.PHP_EOL);
    }
  }


}