<?php
namespace Core;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
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