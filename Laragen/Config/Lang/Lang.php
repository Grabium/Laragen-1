<?php
namespace Laragen\Config\Lang;

use Laragen\App\Json;

class Lang
{
  
  public function onLoad()
  {
    $this->setLockLangFgen(false);
    $notification = false;
    if(!$language = $this->isSetted()){
      $this->setLockLangFgen(true);
      $this->update('temporary/temporary');
      $language = $this->choseALang();
      $this->set($language);
      $notification = true;
    }
    $this->update($language, $notification);
  }

  public function setLockLangFgen(bool $lock = false)
  {
    $config = Json::getJson(__DIR__.'/../config.json');
    $config['block_call_langFgen'] = $lock;
    Json::setJson(__DIR__.'/../config.json', $config);
  }

  public function isSetted():bool|string
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
    
    $languages = [];
    $dir = __DIR__.'/packs_lang/';
    $patchs = scandir($dir, SCANDIR_SORT_NONE);
    
    foreach($patchs as $p){
      if(($p == '..')||($p== '.')||(is_dir($dir.$p))){continue;}
      $languages[] = substr($p, 0, -5);
    }
    
    while(true){
      print $GLOBALS['lang']['l1032'];
      
      foreach($languages as $language){
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

  //troca a língua mas não a carrega.
  public function set(string $language = 'en-us')
  {
    $config = Json::getJson(__DIR__.'/../config.json');
    $config['lang'] = $language;
    Json::setJson(__DIR__.'/../config.json', $config);
  }

  public function update(string $language, bool $notification = false)
  {
    global $lang;//variável global que irá receber array de getJson().
    $language = __DIR__.'/packs_lang/'.$language.'.json';

    if(!file_exists($language)){
      exit("Language pack not found!\n");
    }

    $lang = Json::getJson($language);

    if($notification){
      print $GLOBALS['lang']['l1031'];
    }

  }
}