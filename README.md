
## Instalação do projeto

OBS: O projeto requer o Docker instalado.

- Faça o clone do repositório
- Entre na pasta do projeto
- Copie o arquivo .env.example para .env (cp .env.example .env)
- Instale as dependências do projeto ```docker run --rm \
  -v $(pwd):/opt \
  -w /opt \
  laravelsail/php80-composer:latest \
  composer install```
- Execute o comando ./vendor/bin/sail up -d para subir o container 
- Execute o comando ./vendor/vin/sail test (todos os testes devem passar).
