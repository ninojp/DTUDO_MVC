<?php
// Inclui a classe ConfigController q está no namespace CORE
use Core\ConfigController;
//Inclui o arquivo autoload.php do COMPOSER
include_once './vendor/autoload.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dtudo</title>
</head>
<body>
    <?php
        //instancia a classe ConfigController(responsável por tratar a URL) e cria o objeto $url
        $url = new ConfigController();
        //Usa o objeto $url para instanciar o método loadPage(), para carregar as paginas/controller
        $url->loadPage();
    ?>
</body>
</html>