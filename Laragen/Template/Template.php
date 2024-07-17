<?php
namespace Laragen\Template;

class Template
{
  private string       $tag = '';
  private array  $arrayData = [];
  private string $localFile = '';
  
  public function __construct(array $arrayData)
  {
    $this->tag = $arrayData['tag'];
    $this->localFile = $arrayData['localFile'];
    $this->arrayData = $arrayData['data'];
  }

  public function overrideFile(): string
  {
    $contentFile = implode("", file($this->localFile));//string
    require __DIR__.'/variables/'.$this->tag.'.php';//remake contentFile
    file_put_contents($this->localFile, $contentFile);
    return true;
  }
}
  