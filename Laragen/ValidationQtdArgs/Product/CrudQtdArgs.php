<?php
namespace Laragen\ValidationQtdArgs\Product;

use Laragen\App\App;

class CrudQtdArgs extends QtdArgs
{  
  public function validateQtdArgs(array $arguments)
  {
    if(count($arguments) != 1){
      exit($GLOBALS['lang']['l1001'].PHP_EOL);
    }
  }
}