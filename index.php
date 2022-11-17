<?php
session_start();//iniciar a sessão
ob_start();// após o redirecionamento, Limpar os dados do buffer de saida 

//Constante q define q o usuario está acessando paginas internas através da página "index.php"
//numero(alfanumérico) aléatório depois pode ser alterado 
define('C7E3L8K9E5',true);

// Inclui a classe ConfigController q está no namespace CORE
use Core\ConfigController;

//Inclui o arquivo autoload.php do COMPOSER
include_once './vendor/autoload.php'; 

//instancia a classe ConfigController(responsável por tratar a URL) e cria o objeto $url
$url = new ConfigController();

//Usa o objeto $url para instanciar o método loadPage(), para carregar as paginas/controller
$url->loadPage(); ?>
