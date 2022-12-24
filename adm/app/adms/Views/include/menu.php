<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
//cria uma variável:$sidebar_active. Verifica se contém valor no array:$this->data['sidebarActive'], se tiver coloca o valor na variável criada.
$sidebar_active = "";
if(isset($this->data['sidebarActive'])){
    $sidebar_active = $this->data['sidebarActive'];
} ?>
<!-- Inicio do conteúdo da pagina ADM -->
<main class="main_content">
    <!-- Inicio do SIDE-BAR -->
    <div class="sidebar">
        <a href="<?=URLADM;?>dashboard/index" class="sidebar_nav <?php if($sidebar_active=="dashboard"){echo "active";}?>">
            <i class="icon fa-solid fa-table-columns"></i><span>Dashboard</span></a>
        <a href="<?=URLADM;?>list-users/index" class="sidebar_nav <?php if($sidebar_active=="list-users"){echo "active";}?>">
            <i class="icon fa-solid fa-users"></i><span>Usuários</span></a>
        <a href="<?=URLADM;?>list-sits-users/index" class="sidebar_nav <?php if($sidebar_active=="list-sits-users"){echo "active";}?>">
            <i class="icon fa-brands fa-wpforms"></i><span>Situação Usuários</span></a>
        <a href="<?=URLADM;?>list-email-confs/index" class="sidebar_nav <?php if($sidebar_active=="list-email-confs"){echo "active";}?>">
            <i class="icon fa-solid fa-table-list"></i></i><span>Configurações E-mail</span></a>
        <a href="<?=URLADM;?>list-colors/index" class="sidebar_nav <?php if($sidebar_active=="list-colors"){echo "active";}?>">
            <i class="icon fa-solid fa-palette"></i><span>Cores</span></a>
        <a href="<?=URLADM?>logout/index" class="sidebar_nav">
            <i class="icon fa-solid fa-right-from-bracket"></i><span>Sair</span></a>
    </div>
    <!-- FIM do SIDE-BAR -->
    
<!-- <div class="container">
    <div class="row text-center"><hr>
        <a class="btn btn-sm btn-primary" href="<?=URLADM?>dashboard/index">Dashboard</a>
        <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-users/index">Usuários</a>
        <a class="btn btn-sm btn-primary" href="<?=URLADM?>view-profile/index">Perfil</a>
        <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-email-confs/index">Config-Emails</a>
        <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-sits-users/index">Situações</a>
        <a class="btn btn-sm btn-primary" href="<?=URLADM?>list-colors/index">Cores</a>
        <a class="btn btn-sm btn-primary" href="<?=URLADM?>logout/index">Sair</a>
    </div>
</div> -->


