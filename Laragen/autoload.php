<?php



spl_autoload_register(function ($nomeCompletoDaClasse){

  $caminhoCompleto  = str_replace('Laragen', 'Laragen', $nomeCompletoDaClasse);
  $caminhoDoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);
  $caminhoDoArquivo = $caminhoDoArquivo.'.php';//exit($caminhoDoArquivo);
  
  if(!file_exists($caminhoDoArquivo)) {
    exit('Erro no autoload. Arquivo: '.$caminhoDoArquivo.' NÃO encontrado.'.PHP_EOL);
  }

  require_once $caminhoDoArquivo;
});
