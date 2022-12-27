<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/users/viewUser.php <h1> Pagina(view) para vizualizar os usuários</h1>";
// var_dump($this->data);
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }
// echo "<h1>Detalhes do Usuário</h1>";
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-users/index'> Listar Usuários</a> ";
// if(!empty($this->data['viewUsers'])){
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-users/index/".$this->data['viewUsers'][0]['id']."'> Editar Usuário</a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-users-password/index/".$this->data['viewUsers'][0]['id']."'><i class="fa-solid fa-unlock-keyhole"></i> Editar Senha </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-users-image/index/".$this->data['viewUsers'][0]['id']."'> Editar Imagem</a>";
//     echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-users/index/".$this->data['viewUsers'][0]['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar Usuário</a><br><hr>";
// }
// if(!empty($this->data['viewUsers'])){
//     // var_dump($this->data['viewUsers'][0]);
//     extract($this->data['viewUsers'][0]);
//     if ((!empty($image)) and (file_exists("app/adms/assets/imgs/users/$id/$image"))) {
//         echo "<img src='" . URLADM . "app/adms/assets/imgs/users/$id/$image' width='200' height='200'><br><br>";
//     } else {
//         echo "<img src='" . URLADM . "app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png' width='300' height='100'><br><br>";
//     }
//     echo "ID: $id <br>";
//     echo "Nome: $name_usr <br>";
//     echo "E-mail: $email <br>";
//     echo "Nickname: $nickname <br>";
//     echo "user: $user <br>";
//     echo "Situação do usuário: $adms_sits_user_id = $name_sit <br>";
//     echo "Cor da Situação: <span style='background-color:$color_col;'> $name_col = $color_col </span><br>";
//     echo "image: $image <br>";
//     echo "Created: ".date('d/m/Y H:i;s', strtotime($created))."<br>";
//     echo "Modified: ";
//     if(!empty($modified)){
//         echo date('d/m/Y H:i;s', strtotime($modified))."<br><hr>";
//     }
// }
?>

<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper">
    <div class="row">
            <div class="col-3 title_content">
                <?php if(!empty($this->data['viewUsers'])){
                    // var_dump($this->data['viewUsers'][0]);
                    extract($this->data['viewUsers'][0]);
                    if ((!empty($image)) and (file_exists("app/adms/assets/imgs/users/$id/$image"))) {
                        echo "<img src='".URLADM."app/adms/assets/imgs/users/$id/$image' width='200' height='200'><br><br>";
                    } else {
                        echo "<img src='".URLADM."app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png' width='300' height='100'><br><br>";
                }?></div>
            <div class="col-9 title_content">
                <h2 class="text-center">Detalhes do Usuário</h2>
                <a class="btn btn-sm btn-outline-success mx-1" href="<?=URLADM;?>list-users/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a>
                <a class="btn btn-sm btn-outline-warning mx-1" href="<?=URLADM;?>edit-users/index/<?=$id;?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
                <a class="btn btn-sm btn-outline-info mx-1" href="<?=URLADM;?>edit-users-password/index/<?=$id;?>"><i class="fa-solid fa-unlock-keyhole"></i> Editar Senha</a>
                <a class="btn btn-sm btn-outline-primary mx-1" href="<?=URLADM;?>edit-users-image/index/<?=$id;?>"><i class="fa-solid fa-image"></i> Editar Imagem</a>
                <a class="btn btn-sm btn-outline-danger mx-1" href="<?=URLADM;?>delete-users/index/index/<?=$id;?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar Usuário</a>
            </div>
        <span class="espaco_alert"></span>
        <!-- Mensagens de avisos -->
        <?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        } ?>
        </span>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$id;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome:</span>
                <span class="view_det_info"><?=$name_usr;?></span>
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
            <div class="view_det">
                <span class="view_det_title">User:</span>
                <span class="view_det_info"><?=$user;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Situação Usuário:</span>
                <span class="view_det_info"><span style='color:<?=$color_col;?>'><?=$name_sit;?></span></span>
            </div>
            <?php if(!empty($image)) { ?>
            <div class="view_det">
                <span class="view_det_title">Imagem name:</span>
                <span class="view_det_info"><?=$image;?></span>
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
            <?php } ?>
        </div>
    </div>
</div>
<!-- FIM do conteudo do ADM -->