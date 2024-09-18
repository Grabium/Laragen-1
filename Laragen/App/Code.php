<?php
namespace Laragen\App;

class Code
{
  public static function runCode(string $code): string
  {
    print $GLOBALS['lang']['l1002'].PHP_EOL.PHP_EOL;
    $exitLine = shell_exec($code);//return shell string 
    print $exitLine.PHP_EOL;
    return $exitLine;
  }
}  