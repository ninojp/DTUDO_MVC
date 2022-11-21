<?php
namespace Core;
abstract class Config
{
    protected function configAdm()
    {
        define('URL','https://localhost/DTUDO_MVC/');
        define('URLADM','https://localhost/DTUDO_MVC/adm/');

        define('CONTROLLER','Login');
        define('METODO','index');
        define('CONTROLLERERRO','Login');

        define('EMAILADM', 'meu.sem@gmail.com');

        //credenciais do DB
        define('HOST','localhost');
        define('USER','root');
        define('PASS','');
        define('DBNAME','celke_adm');
        define('PORT',3306);
    }
}