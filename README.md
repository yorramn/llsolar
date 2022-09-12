
# Setup Docker Para Projetos Laravel 9 com PHP 8
[Assine a Academy, e Seja VIP!](https://academy.especializati.com.br)

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/yorramn/llsolar.git llsolar
```

```sh
cd llsolar/
```

Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=llsolar


DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=llsolar
DB_USERNAME=llsolar
DB_PASSWORD=llsolar

USER= seu user
UID=seu uid
```


Suba os containers do projeto
```sh
docker-compose up -d --build
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse o projeto
[http://localhost:8180](http://localhost:8180)
