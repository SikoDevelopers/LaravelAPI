# TrabalhoSemestral LaravelAPI

## Configuracao Inicial
1. Crie uma pasta com o nome SikoSSP (pasta root do projecto) - a pasta que vai conter os dois projectos angular e laravel
1. baixar ou clonar o Projecto para a pasta SikoSSP
2. Entre no directorio root (SikoSSP) - `cd SikoSSP`
4. Entre no directorio da aplicacao laravel - `LaravelAPI`

### Para Laravel:
1. Crie uma base de dados com nome `sup3`;
2. Entre no directorio da aplicacao Laravel - `cd LaravelAPI/`
3. Instale as dependencias da aplicacao Laravel `composer install`
4. Gere as tabelas na base de dados atraves das mingrations - `php artisan migrate`;
5. Preencha todas a tabelas com dados de testes dos seeders -  `php artisan db:seed`;
6. Sirva a aplicacao - "php aritsan serve"

Para testar se os dados foram gerados de facto execute o seguinte:
* `php artisan tinker`
* `namespace App\Models;`
* `Estudante::all();`






                                                     # TEAM SIKO



