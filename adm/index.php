<?php
use Core\ConfigController;
//Carregar o AUTOLOAD do composer
require './vendor/autoload.php';
// require './core/ConfigController.php';// usado antes do composer
//Instaciar a classe:ConfigController(), responsável em tratar a URL
$home = new ConfigController();
// Instaciar o método para carregar a pagina/controller
$home->loadPage();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area administrativa</title>
    <link rel="stylesheet" href="<?=URLADM?>app/adms/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=URLADM?>app/adms/assets/css/aw_all.min.css">
    <!--  Meu CSS - geral para o ADM ----------------------------------->
    <link rel="stylesheet" href="<?=URLADM?>app/adms/assets/css/adm.css">
    
</head>
<body>
   
<script src="<?=URLADM?>app/adms/assets/js/all.js"></script>
</body>
</html>