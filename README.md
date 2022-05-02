
## Instalação do projeto

OBS: O projeto requer o Docker instalado.

- Faça o clone do repositório ```git clone https://github.com/rafaelhbarreto/smoothies-test.git```
- Entre na pasta do projeto ```cd smoothies-test```
- Copie o arquivo de ambiente ```cp .env.example .env```
- Instale as dependências do projeto 
```
    docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
  ```
- Execute o comando ```./vendor/bin/sail up -d``` para subir o container 
- Crie uma chave de criptografia ```./vendor/bin/sail artisan key:generate```
- Execute o comando ```./vendor/bin/sail test``` (todos os testes devem passar).

## Estrutura

- Todos os testes estão em /tests/unit
- As camadas utilizadas estão em app/Services e app/Repositories
- O json está configurado em /config/smoothies.php

