<?php
namespace Laragen\Config;

use Laragen\Config\Lang\Lang;

class Config
{
  public function __construct()
  {
    $this->loadConfigurations();
  }

  private function loadConfigurations()
  {
    (new Lang())->onLoad();
  }
}