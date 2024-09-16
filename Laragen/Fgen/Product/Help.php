<?php
namespace Laragen\Fgen\Product;



class Help extends Fgen
{
  private string $message = '';

  public function __construct(array $message)
  { 
    $this->argumentsTemp = $message;
    $this->message = (($message != null)&&($message[0] != null)) ? $message[0] : 'Can i help you? ';
  }

  public function run()
  {
    print $this->getContent();
    exit($this->message.PHP_EOL.'Change one of options above!'.PHP_EOL);
  }

  private function getContent()
  {
    return '


    ▒▒▒▒▒▒▒▒▒▒▒▒
    ▒▒▒▒▓▒▒▓▒▒▒▒
    ▒▒▒▒▓▒▒▓▒▒▒▒
    ▒▒▒▒▒▒▒▒▒▒▒▒
    ▒▓▒▒▒▒▒▒▒▒▓▒
    ▒▒▓▓▓▓▓▓▓▓▒▒
    ▒▒▒▒▒▒▒▒▒▒▒▒
    WELLCOME TO
    THE LARAGEN!

    Use one of the syntaxes below:
    -----------------------------------------------------------
    ||
    ||  php gen <function> <arg1|opc> <arg2|opc> ...
    ||
    ||                or
    ||
    ||  php -f gen -- <function> <arg1|opc> <arg2|opc> ...
    ||
    -----------------------------------------------------------


    ____________________List of functions:_____________________

    help................................print this text help.
    crud "entity name example".......complete and basic CRUD.
    '.PHP_EOL.PHP_EOL;
  }

}
