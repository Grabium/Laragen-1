<?php
namespace Laragen\App;

use Laragen\Fgen\Fgen;

class App
{
  private Fgen $fgen;

  public function __construct(int $argc, array $argv)
  {
    $funcArgsValidateds = Validation::callHelpOrNot($argc, $argv);//array(função, argumentos) talvez o help.
    $this->fgen = Fgen::getFunctionGenObjectFactory($funcArgsValidateds);//retorna o objeto/função
    Validation::verifyQtdArgsAccordingFunction($this->fgen);
  }

  public function start()
  {
    $this->fgen->run();
  }

  public function registerProcess()
  {
    //arquivar o processo e entidade num json. chamar de gen
  }
}