<?php
session_start();
ob_start();
use Core\ConfigController;

//Carregar o AUTOLOAD do composer
require './vendor/autoload.php';

// require './core/ConfigController.php';// usado antes do composer
//Instaciar a classe:ConfigController(), responsável em tratar a URL
$home = new ConfigController();

// Instaciar o método para carregar a pagina/controller
$home->loadPage();


   
