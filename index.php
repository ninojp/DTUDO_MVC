<?php

session_start(); // Iniciar a sessão
ob_start(); // Buffer de saida

//Constante que define que o usuário está acessando páginas internas através da página "index.php".
define('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF', true);

//Carregar o Composer
require './vendor/autoload.php';

//Instanciar a classe ConfigController, responsável em tratar a URL
$url = new Core\ConfigController();

//Instanciar o método para carregar a página/controller
$url->loadPage();
