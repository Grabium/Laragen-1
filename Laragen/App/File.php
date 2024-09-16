<?php
namespace Laragen\App;

class File
{
  /*********
  * Ao invés de um try-catch para as factories que são baseadas em entradas
  * de usuários, classExist retorna um false para o módulo fazer um tratamento
  * adequado.
  ***********/
  public static function classExist(string $nomeCompletoDaClasse):bool
  {
    $caminhoCompleto  = str_replace('Laragen', 'Laragen', $nomeCompletoDaClasse);
    $caminhoDoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);
    $caminhoDoArquivo = $caminhoDoArquivo.'.php';
    
    return file_exists($caminhoDoArquivo);
  }
}