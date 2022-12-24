<?php
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){
    // Redireciona para a pagina escolhida
    // header("Location: /");
    header("Location: https://localhost/dtudo/public/");
    // Ou termina a execução e exibe a mensagem de erro
    die("Erro! Página não encontrada<br>");
}

echo "Views/dashboard/dashboard.php<h1>Pagina(view) Dashboard</h1>";

echo "Bem Vindo ".$_SESSION['user_name']."!<br>";
//realiza o logout, url raiz:URLADM + nome da classe:Logout + nome do método:index
// echo "<a href='".URLADM."logout/index'>Sair</a><br>";