<?php
namespace Laragen\App;

use Laragen\Fgen\Fgen;

class App
{
  private Fgen $fgen;

  public function __construct(int $argc, array $argv)
  {
    $funcArgsValidateds = Validate::initialValidation($argc, $argv);//array(função, argumentos)
    $this->fgen = Fgen::getFunctionGenObjectFactory($funcArgsValidateds);//retorna o objeto/função
    unset($argc, $argv, $funcArgsValidateds);
  }

  public function start()
  {
    Validate::ifBrokenArgs($this->fgen);//pode chamar um exit().
    $this->fgen->run();
  }
}