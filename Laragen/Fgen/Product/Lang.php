<?php
namespace Laragen\Fgen\Product;

use Laragen\Config\Lang\Lang as Lang_config;

class Lang extends Fgen
{
  public array $argumentsTemp = [];
  private Lang_config $lang;
  
  public function __construct(array $argumentsTemp)
  {
    $this->argumentsTemp = $argumentsTemp;
    $this->lang = new Lang_config();
  }

  public function run()
  {
    $this->argumentsTemp = [];
    $this->switchLang();
  }

  public function switchLang()
  {
    $language = $this->lang->choseALang();
    $this->lang->set($language);
    //implementar fazer a troca no sistema. pois ele configura o json mas nao troca a var global.
    exit($GLOBALS['lang']['l1031']);
  }
}