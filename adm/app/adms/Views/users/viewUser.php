<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/users/viewUser.php <h1> Pagina(view) para vizualizar os usuários</h1>";
// var_dump($this->data);
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']); }
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
//     } } 
?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Usuário</h2>
        </div>
        <div class="pt-3 text-center">
        <?php if (!empty($this->data['viewUsers'])) {
            // var_dump($this->data['viewUsers'][0]);
            extract($this->data['viewUsers'][0]);
            if ((!empty($image)) and (file_exists("app/adms/assets/imgs/users/$id/$image"))) {
                echo "<img src='" . URLADM . "app/adms/assets/imgs/users/$id/$image' width='200' height='200'><br><br>";
            } else {
                echo "<img src='" . URLADM . "app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png' width='300' height='100'><br><br>";
            } ?>
        </div>
        <div class="col-12 text-center pb-3">
        <?php if($this->data['button']['list_users']) { ?>
            <a class="btn btn-sm btn-outline-success mx-4" href="<?= URLADM; ?>list-users/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php } 
        if($this->data['button']['edit_users_image']) { ?>
            <a class="btn btn-sm btn-outline-primary mx-4" href="<?= URLADM; ?>edit-users-image/index/<?= $id; ?>"><i class="fa-solid fa-image"></i> Editar Imagem</a> <?php } ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome:</span>
                <span class="view_det_info"><?= $name_usr; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">E-mail:</span>
                <span class="view_det_info"><?= $email; ?></span>
            </div>
            <?php if (!empty($nickname)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Apelido:</span>
                    <span class="view_det_info"><?= $nickname; ?></span>
                </div><?php } ?>
            <div class="view_det">
                <span class="view_det_title">User:</span>
                <span class="view_det_info"><?= $user; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Situação Usuário:</span>
                <span class="view_det_info"><span style='color:<?= $color_col; ?>'><?= $name_sit; ?></span></span>
            </div>
            <?php if (!empty($name_lev)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Nivel de Acesso:</span>
                    <!-- Link para OUTRA VIEW:view-access-nivels, passando o id da mesma   -->
                    <span class="view_det_info"><?php echo "<a href='" . URLADM . "view-access-nivels/index/$id_lev'>" .$name_lev. "</a>"; ?></span>
            </div><?php } ?>
            <?php if (!empty($image)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Imagem name:</span>
                    <span class="view_det_info"><?= $image; ?></span>
                </div><?php } ?>
            <div class="view_det">
                <span class="view_det_title">Data Criação:</span>
                <span class="view_det_info"><?= date('d/m/Y H:i:s', strtotime($created)); ?></span>
            </div>
            <?php if (!empty($modified)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Modificado:</span>
                    <span class="view_det_info"><?= date('d/m/Y H:i:s', strtotime($modified)); ?></span>
                </div> <?php } ?>
        </div>
        <div class="col-12 text-center p-4">
        <?php if($this->data['button']['edit_users']) { ?>
            <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>edit-users/index/<?= $id; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a> <?php }
        if($this->data['button']['edit_users_password']) { ?>
            <a class="btn btn-sm btn-outline-info mx-2" href="<?= URLADM; ?>edit-users-password/index/<?= $id; ?>"><i class="fa-solid fa-unlock-keyhole"></i> Editar Senha</a><?php }
        if($this->data['button']['delete_users']) { ?>
            <a class="btn btn-sm btn-outline-danger mx-2" href="<?= URLADM; ?>delete-users/index/<?= $id; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar Usuário</a> <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->