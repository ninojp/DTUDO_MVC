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
        define('CONTROLLERERRO','Erro');
    }
}