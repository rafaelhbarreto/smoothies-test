
## Instalação do projeto

OBS: O projeto requer o Docker instalado.

- Faça o clone do repositório
- Entre na pasta do projeto
- Copie o arquivo ```.env.example para .env``` (cp .env.example .env)
- Crie uma chave de criptografia ```./vendor/bin/sail artisan key:generate```
- Instale as dependências do projeto 
```
    docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
  ```
- Execute o comando ```./vendor/bin/sail up -d``` para subir o container 
- Execute o comando ```./vendor/bin/sail test``` (todos os testes devem passar).

## Estrutura

- Todos os testes estão em /tests/unit
- As camadas utilizadas estão em app/Services e app/Repositories
- O json está configurado em /config/smoothies.php

