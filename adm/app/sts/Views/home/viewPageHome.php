<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>

<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        } ?>
        <div class="title_form">
            <h2>Detalhes da Página Home</h2>
        </div>
        <div class="">
            View da página Home... Conteúdo!
        </div>
    </div>
</div>
<!-- FIM do conteudo do ADM -->