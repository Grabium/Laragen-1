<?php
namespace Laragen\Config;
//futuramente as funções de configurações devem ser feitas nesta pasta.
//Também devem ser trazidas a este diretório a pasta:
//Laragen/App/config/
//Isso deve influenciar:
//Laragen/SystemPart/Migration/Column.php em $this->patternType.

use Laragen\Config\Lang\Lang;

class Config
{
  public function __construct()
  {
    $this->loadConfigurations();
  }

  private function loadConfigurations()
  {
    (new Lang())->load();
  }
}