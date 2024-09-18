<?php
namespace Laragen\Config\Lang;

use Laragen\App\Json;

class Lang
{
  
  public function load()
  {
    if(!$language = $this->isSetted()){
      $language = $this->choseALang();
      $this->set($language);
    }

    global $lang;//variável global que irá receber array de getJson()
    $lang = Json::getJson(__DIR__.'/patch_lang/'.$language.'.json');
  }

  private function isSetted():bool|string
  {
    $config = Json::getJson(__DIR__.'/../config.json');
    $language = $config['lang'];
    if(!$language){
      return false;
    }
    return $language;
  }

  public function choseALang():string
  {
    $patchs = scandir(__DIR__.'/patch_lang',SCANDIR_SORT_NONE);
    $languages = [];
    
    foreach($patchs as $i => $p){
      if(($p == '..')||($p== '.')){continue;}
      $languages[] = substr($p, 0, -5);
    }
    
    while(true){
      print 'Type an language below:'.PHP_EOL;
      
      foreach($languages as $i => $language){
        print $language.PHP_EOL;
      }
      
      $inputChoice = trim(fgets(fopen('php://stdin', 'r')));
      $inputChoice = strtolower($inputChoice);
      
      if(in_array($inputChoice, $languages)){
        break;
      }
    }
    
    return $inputChoice;
  }

  //deve receber solicitações de load() ou de um comando shell futuramente
  public function set(string $language = 'en-us')
  {
    $config = Json::getJson(__DIR__.'/../config.json');
    $config['lang'] = $language;
    Json::setJson(__DIR__.'/../config.json', $config);
  }
}