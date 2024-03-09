<?php

namespace Utils;

// Util para manipular variáveis de ambiente de arquivos .env
class Dotenv
{
  public function load(string $path): void
  {
    // Busca todas as linhas do arquivo .env, de acordo com o caminho $path
    $lines = file($path, FILE_IGNORE_NEW_LINES);

    // Percorre as linhas
    foreach ($lines as $line) {
      // Divide a chave e valor de cada variável, usando "=' como separador
      list($key, $value) = explode("=", $line, 2);

      // Atribui ao $_ENV cada chave e valor do arquivo vindo do $path 
      $_ENV[$key] = $value;
    }
  }
}
