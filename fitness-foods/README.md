<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Challenge Truckpag - Fitness Foods

Este projeto é uma API REST desenvolvida para o desafio Backend Challenge 20230105.

>  This is a challenge by [Coodesh](https://coodesh.com/)


## Apresentação

Primeiramente foi definida a seguinte arquitetura:

### Ferramentas utilzadas.
* PHP 8.3
* Laravel 10
* Mysql
* Laravel Horizon
* Laravel Pint
* Swagger
* Pest

### Criação de um sistema monolíto com as seguintes caracteristicas.
* API REST para atender as consultas da empresa.
* Sitema de importação automáticas de produtos.
* Habilitado o Laravel Horizon para o monitoramento dos Jobs.
* Foram criadas as camadas de Repository, Services, Observes e Form Request para separar as resposabilidades.
* Sistema dockerizado com Laravel Sail.
* Automatizaçao do cron e disparo de jobs.

### Integrações com plataformas terceiras visando a otimização do projeto.
* Algolia - Tem a função de otimizar as consultas para o endpoint search
* Sentry - Para monitorar possíveis erros do Sync de produtos e também receber alertas de todo sistema



## Instalação

1. **Clone o Repositório:**
    ```bash
    git clone https://github.com/ocdigital/products-parser-20240426.git
    ```

2. **Acesse o Diretório do Projeto:**
    ```bash
    cd products-parser-20240426/fitness-foods
    ```

3. **Instale as dependencias para habilitar o Sail**
    ```bash
    composer install
    ```

4. **Execute o Ambiente em Modo de Segundo Plano:**
    ```bash
    ./vendor/bin/sail up -d
    ```

4. **Para executar os Testes:**
    ```bash
    docker exec -it expenses_api-app-1 php artisan test
    ```


## Documentação da API

Explore a documentação da API em http://localhost:8000/api/documentation.

Caso queria utilizar Postman, há um arquivo de configuração na raiz do projeto: expenses_api.postman_collection.json

## Algumas informações

Aplicação: http://localhost:8000.

Horizon: http://localhost:8000/horizon.

MailCatcher: http://localhost:1080.

O backend está utilizando token para atenticação, então é necessário fazer login na api
para gerar o token.

Passos para gerar a despesa:
-Faça o login com admin e adicione o token a ferramenta (postman ou no Swagger).

-Crie um usuário.

-Crie um novo cartão atribuindo o id do usuário. 

-Crie uma nova despesa utilizando o numero do cartão.

-Pode visualizar os emails no MailCatcher e os logs no Horizon 😀
