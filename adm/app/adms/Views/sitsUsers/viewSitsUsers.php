<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "<h1>Detalhes da Situação</h1>";
// // var_dump($this->data['viewSitsUsers'][0]);
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-sits-users/index'> Listar </a><br><hr>";
// // if(!empty($this->data['viewSitsUsers'])){
// //     extract($this->data['viewSitsUsers'][0]);
// //     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-sits-users/index/$id'> Editar </a>";
// //     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-sits-users/index/$id'> Apagar </a><br><hr>";
// // }
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }
// if(!empty($this->data['viewSitsUsers'])){
//     extract($this->data['viewSitsUsers'][0]);
//     echo "ID: $id<br>";
//     echo "Situação: $sitsname<br>";
//     echo "Cor Situação:<span style='background-color:$color;color:#fff;'> $colname</span><br>";
//     echo "Situação criada: ". date('d/m/Y H:i:s', strtotime($created)) ."<br>";
//     if(!empty($modified)){
//         echo "Situação Modificada:". date('d/m/Y H:i:s', strtotime($modified)) ."<br>";
//     }
//     echo "<br>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-sits-users/index/$id'> Editar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-sits-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
// }
?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes da Situação</h2>
        </div>
    <?php if (!empty($this->data['viewSitsUsers'])) {
        extract($this->data['viewSitsUsers'][0]); 
        if (isset($_SESSION['msg'])) { 
        echo "<div id='msg' class='msg_alert'>";
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        echo "</div>"; }
    ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Situação:</span>
                <span class="view_det_info"><?= $sitsname; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Cor Situação:</span>
                <span class="view_det_info"><span style='background-color:<?= $color; ?>;color:#fff;'><?= $colname; ?></span></span>
            </div>
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
            <a class="btn btn-sm btn-outline-success mx-1" href="<?= URLADM; ?>list-sits-users/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a>
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>edit-sits-users/index/<?= $id; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
            <a class="btn btn-sm btn-outline-danger mx-1" href="<?= URLADM; ?>delete-sits-users/index/<?= $id; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->