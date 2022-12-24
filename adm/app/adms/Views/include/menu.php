<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); } ?>
<!-- Inicio do conteúdo da pagina ADM -->
<main class="main_content">
    <!-- Inicio do SIDE-BAR -->
    <div class="sidebar">
        <a href="adm.php" class="sidebar_nav active"><i class="icon fa-solid fa-table-columns"></i><span>Dashboard</span></a>
        <a href="listar_dash.php" class="sidebar_nav"><i class="icon fa-solid fa-table-list"></i><span>Listar</span></a>
        <a href="formulario_dash.php" class="sidebar_nav"><i class="icon fa-brands fa-wpforms"></i><span>Formulário</span></a>
        <a href="view_dash.php" class="sidebar_nav"><i class="icon fa-solid fa-eye"></i><span>Visualizar</span></a>
        <a href="login.php" class="sidebar_nav"><i class="icon fa-solid fa-person-walking-dashed-line-arrow-right"></i><span>Sair</span></a>
    </div>
    <!-- FIM do SIDE-BAR -->



<div class="container">
    <div class="row text-center"><hr>
        <div class="col-2">
            <a class="btn btn-sm btn-primary" href="<?=URLADM?>dashboard/index">Dashboard</a>
        </div>
        <div class="col-2">
            <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-users/index">Usuários</a>
        </div>
        <div class="col-1">
            <a class="btn btn-sm btn-primary" href="<?=URLADM?>view-profile/index">Perfil</a>
        </div>
        <div class="col-2">
            <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-email-confs/index">Config-Emails</a>
        </div>
        <div class="col-2">
            <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-sits-users/index">Situações</a>
        </div>
        <div class="col-1">
            <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-colors/index">Cores</a>
        </div>
        <div class="col-1">
            <a class="btn btn-sm btn-primary" href="<?=URLADM?>logout/index">Sair</a>
        </div>
    </div>
</div><hr>


