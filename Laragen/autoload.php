<?php



spl_autoload_register(function ($nomeCompletoDaClasse){


  $caminhoCompleto  = str_replace('Laragen', 'Laragen', $nomeCompletoDaClasse);
  $caminhoDoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);
  $caminhoDoArquivo = $caminhoDoArquivo.'.php';


  if(file_exists($caminhoDoArquivo)) {
    require_once $caminhoDoArquivo;
  }else{
    echo $caminhoDoArquivo.' NÃO encontrado.'.PHP_EOL;
  }

});
