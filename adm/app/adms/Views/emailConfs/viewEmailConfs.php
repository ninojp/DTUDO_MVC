<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/users/viewEmailConfs.php <h1> Pagina(view) para vizualizar as Configurações do E-mail</h1>";
// var_dump($this->data);
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }
// echo "<h1>Detalhes da Configuração do E-mail</h1>";
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-email-confs/index'> Listar </a>";
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-email-confs/index'>Cadastrar E-mail</a><br><hr>";
// if(!empty($this->data['viewEmailConf'])){
//     // var_dump($this->data['viewEmailConf']);
//     extract($this->data['viewEmailConf'][0]);
//     echo "ID: $id <br>";
//     echo "E-mail: $email <br>";
//     echo "Nome: $name <br>";
//     echo "Titulo: $title <br>";
//     echo "Host: $host <br>";
//     echo "Username: $username <br>";
//     echo "smtpsecure: $smtpsecure<br>";
//     echo "port: $port<br>";
//     echo "Created: ".date('d/m/Y H:i:s', strtotime($created))."<br>";
//     if(!empty($modified)){ echo "Modified: ".date('d/m/Y H:i:s', strtotime($modified)); }
//     echo "<br><br>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-email-confs/index/$id'> Editar</a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-email-confs-pass/index/$id'> Editar Senha </a>";
//     echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-email-confs/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
// }?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
                <h2>Detalhes do E-mail</h2>
            </div>
        <?php if (!empty($this->data['viewEmailConf'])) {
            extract($this->data['viewEmailConf'][0]); 
            if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; }
        ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$id;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Titulo:</span>
                <span class="view_det_info"><?=$title;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome:</span>
                <span class="view_det_info"><?=$name;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">E-mail:</span>
                <span class="view_det_info"><?=$email;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">UserName:</span>
                <span class="view_det_info"><?=$username;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Host:</span>
                <span class="view_det_info"><?=$host;?></span>
            </div>
            <?php if(!empty($port)) { ?>
            <div class="view_det">
                <span class="view_det_title">Port:</span>
                <span class="view_det_info"><?=$port;?></span>
            </div><?php } ?>
            <?php if(!empty($nickname)) { ?>
            <div class="view_det">
                <span class="view_det_title">smtpsecure:</span>
                <span class="view_det_info"><?=$smtpsecure;?></span>
            </div><?php } ?>
            <div class="view_det">
                <span class="view_det_title">Data Criação:</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($created));?></span>
            </div>
            <?php if(!empty($modified)) { ?>
            <div class="view_det">
                <span class="view_det_title">Modificado:</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($modified)); ?></span>
            </div> <?php } ?>
        </div>
        <div class="col-12 text-center p-4">
            <a class="btn btn-sm btn-outline-success mx-1" href="<?=URLADM;?>list-email-confs/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a>
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?=URLADM;?>edit-email-confs/index/<?=$id;?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
            <a class="btn btn-sm btn-outline-info mx-1" href="<?=URLADM;?>edit-email-confs-pass/index/<?=$id;?>"><i class="fa-solid fa-unlock-keyhole"></i> Editar Senha</a>
            <a class="btn btn-sm btn-outline-danger mx-1" href="<?=URLADM;?>delete-email-confs/index/<?=$id;?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->