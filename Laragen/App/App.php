<?php
namespace Laragen\App;

use Laragen\Fgen\FactoryMethod\FgenCreator;
use Laragen\Config\Config;
use Laragen\Fgen\Product\Fgen;

class App
{
  private  Fgen $fgen;
  
  public function __construct(int $argc, array $argv)
  {
    new Config();
    $funcArgsValidateds = Validation::callHelpOrNot($argv);//array(função, argumentos) talvez o help.
    $this->fgen = FgenCreator::callFactory($funcArgsValidateds);//retorna o objeto/função
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

