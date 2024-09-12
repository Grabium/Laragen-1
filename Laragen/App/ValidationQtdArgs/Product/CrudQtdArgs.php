<?php
namespace Laragen\App\ValidationQtdArgs\Product;

class CrudQtdArgs extends QtdArgs
{
  public function validateQtdArgs(array $arguments)
  {
    if(count($arguments) != 1){
      exit('Inadequate number of arguments. Please try: php gen help'.PHP_EOL);
    }
  }
}