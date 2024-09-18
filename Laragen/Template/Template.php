<?php
namespace Laragen\Template;

class Template
{
  private string      $flag = '';
  private array  $arrayData = [];
  private string $localFile = '';
  
  public function __construct(array $arrayData)
  {
    $this->flag      = $arrayData['flag'];
    $this->localFile = $arrayData['localFile'];
    $this->arrayData = $arrayData['data'];
  }

  public function overrideFile(): string
  {
    $contentFile = implode("", file($this->localFile));//string
    require __DIR__.'/variables/'.$this->flag.'.php';//remake contentFile
    file_put_contents($this->localFile, $contentFile);
    return true;
  }
}
  