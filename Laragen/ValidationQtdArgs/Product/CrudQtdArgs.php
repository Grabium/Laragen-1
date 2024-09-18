<?php
namespace Laragen\ValidationQtdArgs\Product;

use Laragen\App\App;

class CrudQtdArgs extends QtdArgs
{
  //global $glt;//definida em App/App
  
  public function validateQtdArgs(array $arguments)
  {
    if(count($arguments) != 1){
      global $lang;//definida em App/App
      //print $lang;
      //print $GLOBALS['teste'];
      //print_r($GLOBALS);
      exit($lang['l1001'].PHP_EOL);//criar classe.
      //exit('Inadequate number of arguments. Please try: php gen help'.PHP_EOL);
    }
  }
}