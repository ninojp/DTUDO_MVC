<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
//cria uma variável:$sidebar_active. Verifica se contém valor no array:$this->data['sidebarActive'], se tiver coloca o valor na variável criada.
$sidebar_active = "";
if(isset($this->data['sidebarActive'])){
    $sidebar_active = $this->data['sidebarActive'];
} 
// Criado para o menu DROPDOWN apenas

?>
<!-- Inicio do conteúdo da pagina ADM -->
<main class="main_content">
    <!-- Inicio do SIDE-BAR -->
    <div class="sidebar">
        <?php $dashboard = "";
            if($sidebar_active=="dashboard"){
            $dashboard = "active";} ?>
        <a href="<?=URLADM;?>dashboard/index" class="sidebar_nav <?= $dashboard;?>"><i class="icon fa-solid fa-table-columns"></i><span>Dashboard</span></a>

        <?php $list_users = "";
        $dropDown = "";
        if($sidebar_active=="list-users"){
            $list_users = "active";
            $dropDown = "active"; } ?>
        <a href="<?=URLADM;?>list-users/index" class="sidebar_nav <?=$list_users;?>"><i class="icon fa-solid fa-users"></i><span>Usuários</span></a>

        <?php $sits_users = "";
        if($sidebar_active=="list-sits-users"){
            $sits_users = "active";
            $dropDown = "active"; } ?>
        <a href="<?=URLADM;?>list-sits-users/index" class="sidebar_nav <?=$sits_users;?>"><i class="icon fa-solid fa-users-line"></i><span>Situação Usuários</span></a>

        <?php $list_access_nivels = "";
        if($sidebar_active=="list-access-nivels"){
            $list_access_nivels = "active"; } ?>
        <a href="<?=URLADM;?>list-access-nivels/index" class="sidebar_nav <?=$list_access_nivels;?>"><i class="icon fa-solid fa-key"></i><span>Niveis de Acesso</span></a>

        <?php $types_pgs = "";
        if($sidebar_active=="list-types-pgs"){
            $types_pgs = "active"; } ?>
        <a href="<?=URLADM;?>list-types-pgs/index" class="sidebar_nav <?=$types_pgs;?>"><i class="icon fa-brands fa-wpforms"></i><span>Tipos de Paginas</span></a>

        <?php $email_confs = "";
        if($sidebar_active=="list-email-confs"){
            $email_confs = "active";
            $dropDown = "active";}?>
        <a href="<?=URLADM;?>list-email-confs/index" class="sidebar_nav <?=$email_confs;?>"><i class="icon fa-solid fa-table-list"></i><span>Configurações E-mail</span></a>

        <?php $list_colors = "";
        if($sidebar_active=="list-colors"){
            $list_colors = "active"; }?>
        <a href="<?=URLADM;?>list-colors/index" class="sidebar_nav <?=$list_colors;?>"><i class="icon fa-solid fa-palette"></i><span>Cores</span></a>

        <a href="<?=URLADM?>logout/index" class="sidebar_nav"><i class="icon fa-solid fa-right-from-bracket"></i><span>Sair</span></a>

        <!-- EXEMPLO: MENU DROPDOWN do Dashboard -->
        <button class="dropdown-btn <?=$dropDown;?>">
        <i class="icon fa-solid fa-chalkboard-user"></i>DropDown Users <i class="fa-solid fa-caret-down"></i>
        </button>
            <div class="dropdown-container <?=$dropDown;?>">
                <a href="<?=URLADM;?>list-users/index" class="sidebar-nav <?=$list_users;?>"><i class="icon fa-solid fa-users"></i><span> Listar Usuários</span></a>

                <a href="<?=URLADM;?>list-sits-users/index" class="sidebar-nav <?php if($sidebar_active=="list-sits-users"){echo "active";}?>"><i class="icon fa-brands fa-wpforms"></i><span> Situações do usuário</span></a>

                <a href="<?=URLADM;?>list-email-confs/index" class="sidebar-nav <?=$email_confs;?>"><i class="icon fa-solid fa-table-list"></i><span> E-Mail Configs</span></a>

            </div>
    </div>
    <!-- FIM do SIDE-BAR -->