<?php
namespace Laragen\SystemPart;

class Model
{
  public function __construct(string $name)
  {
    $this->name = $name;
    print 'model: '.$this->name;
    //nome_da_tabela, colunas, hidden, fillable...
  }
}