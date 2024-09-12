<?php
namespace Laragen\App\ValidationQtdArgs;

class CrudValidationQtdArgs extends ValidationQtdArgs
{
  public function validateQtdArgs(array $arguments)
  {
    if(count($arguments) != 1){
      exit('Inadequate number of arguments. Please try: php gen help'.PHP_EOL);
    }
  }
}