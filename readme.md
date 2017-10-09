# TrabalhoSemestral LaravelAPI

## Configuracao Inicial
1. Crie uma pasta com o nome SikoSSP (pasta root do projecto) - a pasta que vai conter os dois projectos angular e laravel
1. baixar ou clonar o Projecto para a pasta SikoSSP
2. Entre no directorio root (SikoSSP) - `cd SikoSSP`
4. Entre no directorio da aplicacao laravel - `LaravelAPI`

### Configuracao do Projecto:
1. Crie uma base de dados com nome `sup3`;
2. Entre no directorio da aplicacao Laravel - `cd LaravelAPI/`
3. Instale as dependencias da aplicacao Laravel `composer install`
4. Instale as dependencias da aplicacao Laravel `composer update`
5. Gere as tabelas na base de dados atraves das mingrations - `php artisan migrate`;
6. Preencha todas a tabelas com dados de testes dos seeders -  `php artisan db:seed`;
7. Sirva a aplicacao - "php aritsan serve"

Para testar se os dados foram gerados de facto execute o seguinte:
* `php artisan tinker`
* `namespace App\Models;`
* `Estudante::all();`



## Documentacao da API
O dominio padrao para acesso aos dados da api eh a a segunte: `http://127.0.0.1:8000/api/`

Esta api disponibilida recursos baseando-se num padrao que consiste no seguinte:

Para buscar dados de um objecto, especificamos o nome do objecto no **plural**.
    Ex:

    pessoa - pessoas
    trabalho - trabalhos
    docente - docentes
    etc...



Ex: Para buscar dados do objecto Estudante

    http://127.0.0.1:8000/api/estudantes





    sdd