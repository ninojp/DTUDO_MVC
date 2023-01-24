<?php

namespace Core;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/**
 * Configurações básicas do site.
 *
 * @author NinoJP <meu.sem@gmail.com>
 */

abstract class Config
{

    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function config(): void
    {
        //URL do projeto
        define('URL', 'https://localhost/DTUDO_MVC/');
        define('URLADM', 'https://localhost/DTUDO_MVC/adm/');

        define('CONTROLLER', 'Home');
        define('CONTROLLERERRO', 'Erro');

        //Credenciais do banco de dados
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '3RtsEpuR21!@');
        define('DBNAME', 'adms_celke');
        define('PORT', 3306);

        define('EMAILADM', 'meu.sem@gmail.com');
    }
}
