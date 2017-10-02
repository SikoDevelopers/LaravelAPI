# TrabalhoSemestral LaravelAPI

## Configuracao Inicial
1. baixar ou clonar o Projecto
2. Entre no directorio root (TrabalhoSemestral) - cd TrabalhoSemestral

Serao apresentados os seguintes directorios:
* AngularApp
* LaravelAPI

Sao os directorios que dividem o projecto nos dois frameworks Angular (Front-end) e Laravel (Back-end)

### Para Laravel:
1. Entre no directorio da aplicacao Laravel - `cd LaravelAPI/`
2. Crie uma base de dados com nome `sup3`;
3. Gere as tabelas na base de dados atraves das mingrations - `php artisan migrate`;
4. Preencha todas a tabelas com dados de testes dos seeders -  `php artisan db:seed`;
5. Sirva a aplicacao - "php aritsan serve"

Para testar se os dados foram gerados de facto execute o seguinte:
php artisan tinker
namespace App\Models;
Estudante::all();


### Para Angular
1. Sirva a aplicacao e as rotas disponibilizadas pela LaravelAPI - `ng serve` ou `npm start`
2. **[Acesse no Navegador] (http://localhost:4200/)**

Nota:Para usar a aplicacao Angular, antes devem-se assegurar que as todas as configuracoes da Aplicacao laravel foram bem Succedidas.


## Estrutura do Projecto

```


```






                                                     # TEAM SIKO



