<?php
namespace Laragen\ValidationQtdArgs\Product;

use Laragen\App\App;

class CrudQtdArgs extends QtdArgs
{  
  public function validateQtdArgs(array $arguments)
  {
    if(count($arguments) != 1){
      global $lang;//definida em Config\Lang
      exit($lang['l1001'].PHP_EOL);
    }
  }
}