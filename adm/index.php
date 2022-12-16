<?php
session_start();
ob_start();
//Constante definida como chave de segurança, para identificar que o usuário está vindo da index para poder acessar as outras paginas do site, o professor definiu apenas com numeros e LETRAS maiúsculas.
define('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF', true);
use Core\ConfigController;

//Carregar o AUTOLOAD do composer
require './vendor/autoload.php';

// require './core/ConfigController.php';// usado antes do composer
//Instaciar a classe:ConfigController(), responsável em tratar a URL
$home = new ConfigController();

// Instaciar o método para carregar a pagina/controller
$home->loadPage();


   
