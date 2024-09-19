<?php
namespace Laragen\Fgen\Product;

use Laragen\Config\Lang\Lang as Lang_config;
use Laragen\App\Json;

//To change the language
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
    
    if(!$this->avoidReWork()){
      $this->switchLang();
    }

    $this->lang->setLockLangFgen(false);
    
  }

  private function switchLang()
  {
    if(!$language = $this->lang->isSetted()){
      $this->update('temporary/temporary');
    }
    
    $language = $this->lang->choseALang();
    $this->lang->set($language);
    $this->lang->update($language, true);
    exit();
  }

  //caso tente "php gen lang" antes de usar "php gen" pela primeira vez.
  private function avoidReWork(): bool
  {
    $config = Json::getJson(__DIR__.'/../../Config/config.json');
    return $config['block_call_langFgen'];
  }
}