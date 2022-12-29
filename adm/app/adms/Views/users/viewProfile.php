<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/users/viewUser.php <h1> Pagina(view) para vizualizar os usuários</h1>";
// var_dump($this->data);
// echo "<h1>Perfil</h1>";

// if (!empty($this->data['viewProfile'])) {
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-profile/index'> Editar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-profile-password/index'> Editar Senha</a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-profile-image/index'> Editar Imagem </a><hr>";
    
// }
// if (isset($_SESSION['msg'])) {
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }
// if (!empty($this->data['viewProfile'])) {
    // var_dump($this->data['viewProfile'][0]);
//     extract($this->data['viewProfile'][0]);
//     if ((!empty($image)) and (file_exists("app/adms/assets/imgs/users/" . $_SESSION['user_id'] . "/$image"))) {
//         echo "<img src='" . URLADM . "app/adms/assets/imgs/users/" . $_SESSION['user_id'] . "/$image' width='200' height='200'><br><br>";
//     } else {
//         echo "<img src='" . URLADM . "app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png' width='300' height='100'><br><br>";
//     }
//     echo "Nome: $name <br>";
//     echo "Nickname: $nickname <br>";
//     echo "E-mail: $email <br><hr>";
// } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
                <h2>Detalhes do Perfil Usuário</h2>
            </div>
        <div class="pt-3 text-center">
        <?php if (!empty($this->data['viewProfile'])) {
            // var_dump($this->data['viewProfile'][0]);
            extract($this->data['viewProfile'][0]);
            if ((!empty($image)) and (file_exists("app/adms/assets/imgs/users/".$_SESSION['user_id']."/$image"))) {
                echo "<img src='".URLADM."app/adms/assets/imgs/users/".$_SESSION['user_id']."/$image' width='200' height='200'><br><br>";
            } else {
                echo "<img src='".URLADM."app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png' width='300' height='100'><br><br>";
            }?>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$_SESSION['user_id'];?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome:</span>
                <span class="view_det_info"><?=$name;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">E-mail:</span>
                <span class="view_det_info"><?=$email;?></span>
            </div>
            <?php if(!empty($nickname)) { ?>
            <div class="view_det">
                <span class="view_det_title">Apelido:</span>
                <span class="view_det_info"><?=$nickname;?></span>
            </div><?php } ?>
            <?php if(!empty($image)) { ?>
            <div class="view_det">
                <span class="view_det_title">Imagem name:</span>
                <span class="view_det_info"><?=$image;?></span>
            </div><?php } ?>
        </div>
        <div class="col-12 text-center p-4">
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?=URLADM;?>edit-profile/index/<?=$_SESSION['user_id'];?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
            <a class="btn btn-sm btn-outline-info mx-1" href="<?=URLADM;?>edit-profile-password/index/<?=$_SESSION['user_id'];?>"><i class="fa-solid fa-unlock-keyhole"></i> Editar Senha</a>
            <a class="btn btn-sm btn-outline-primary mx-1" href="<?=URLADM;?>edit-profile-image/index/<?=$_SESSION['user_id'];?>"><i class="fa-solid fa-image"></i> Editar Imagem</a>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->
