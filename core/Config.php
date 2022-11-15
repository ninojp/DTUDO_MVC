<?php
namespace Core;

/** classe abstrata para não ser instanciada por outras, apenas classes filhas podem instanciala
* Possui as constantes com as configurações.
* Configurações de endereço do projeto.
* Página principal do projeto.
* Credenciais de acesso ao banco de dados
* E-mail do administrador. */
abstract class Config
{
    //=============================================================================================
    /** método protegido para ser usada somente em classes filhas
     * @return void */
    protected function config():void
    {
        //contante definindo url do site
        define('URL','https://localhost/DTUDO_MVC/');
        //contante definindo qual é a pagina INICIAL do site
        define('CONTROLLER','Home');
        define('CONTROLLERERRO','Erro');

        define('EMAILADM','meu.sem@gmail.com');

    }
}