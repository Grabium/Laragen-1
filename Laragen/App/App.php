<?php
namespace Laragen\App;

use Laragen\Fgen\FactoryMethod\Creator;
use Laragen\Fgen\Product\Fgen;

class App
{
  private Fgen $fgen;

  public function __construct(int $argc, array $argv)
  {
    $funcArgsValidateds = Validation::callHelpOrNot($argc, $argv);//array(função, argumentos) talvez o help.
    $this->fgen = Creator::callFactory($funcArgsValidateds);//retorna o objeto/função
    //print var_dump($this->fgen); die();
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