<?php
namespace Laragen\Fgen;

class Help extends Fgen
{
  private string $content;

  public function __construct(array $message)
  {
    print __CLASS__.$message[0].PHP_EOL;
    $this->setContent();
    print $this->content;
    exit($message[0].' Change one of options above!'.PHP_EOL);
  }

  private function setContent()
  {
    $this->content ='


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
