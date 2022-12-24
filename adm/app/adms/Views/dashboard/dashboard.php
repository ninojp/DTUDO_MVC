<?php
//verifica se está definido a constante(defida na index), se não estiver
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    // Redireciona para a pagina escolhida
    // header("Location: /");
    header("Location: https://localhost/dtudo/public/");
    // Ou termina a execução e exibe a mensagem de erro
    die("Erro! Página não encontrada<br>");
}
// echo "Views/dashboard/dashboard.php<h1>Pagina(view) Dashboard</h1>";
// echo "Bem Vindo ".$_SESSION['user_name']."!<br>";
//realiza o logout, url raiz:URLADM + nome da classe:Logout + nome do método:index
// echo "<a href='".URLADM."logout/index'>Sair</a><br>";
?>
<!-- Inicio do conteudo do ADM -->
<div class="wrapper">
    <div class="row">
        <div class="box box_first">
            <span class="class=icon fa-solid fa-users"></span>
            <span>
                <?php
                    if(!empty($this->data['countUsers'])){
                        echo $this->data['countUsers'][0]['qntUsers'];
                    };
                ?>
            </span>
            <span>Usuários</span>
        </div>
        <div class="box box_second">
            <span class="fa-solid fa-truck-fast"></span>
            <span>43</span>
            <span>Entregas</span>
        </div>
        <div class="box box_third">
            <span class="fa-solid fa-circle-check"></span>
            <span>12</span>
            <span>Completas</span>
        </div>
        <div class="box box_fourth">
            <span class="fa-solid fa-triangle-exclamation"></span>
            <span>3</span>
            <span>Alertas</span>
        </div>
    </div>
</div>
<!-- FIM do conteudo do ADM -->