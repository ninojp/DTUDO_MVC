<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Visualizar Detalhes<br> do Artigo Sobre Empresa</h2>
        </div>
        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
        </div>
        <div class="content_adm">
            <?php if (!empty($this->data['viewAboutPg'])) {
                extract($this->data['viewAboutPg'][0]); ?>
                <div class="pt-3 text-center">
                    <?php
                    if ((!empty($image)) and (file_exists("app/sts/assets/imgs/about/$id/$image"))) {
                        echo "<img src='" . URLADM . "app/sts/assets/imgs/about/$id/$image' width='250' ><br>";
                    } else {
                        echo "<img src='" . URLADM . "app/sts/assets/imgs/Logo_Dtudo_2022-300p.png' width='250'><br>";
                    }
                    echo "<span class='view_det_title'>Imagem:</span><br>";
                    echo "<a href='" . URLADM . "edit-about-pg-img/index/$id' class='btn btn-sm btn-warning ms-3'>Editar Imagem</a>";
                    ?>
                </div>
                <div class="view_det">
                    <span class="view_det_title">ID:</span>
                    <span class="view_det_info"><?= $id; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">title:</span>
                    <span class="view_det_info"><?= $title; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">description:</span>
                    <span class="view_det_info"><?= $description; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Situação:</span>
                    <span class="view_det_info"><?= $name; ?></span>
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
                <?php if (!empty($this->data['viewAboutPg'])) {
                    echo "<a href='" . URLADM . "list-about-pg/index' class='btn btn-sm btn-info ms-3'>Listar</a>";
                    echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-about-pg/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";

                    echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-about-pg/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                } ?>
            </div>
        <?php } else {
                echo "<p class='alert alert-danger'>Erro (viewAboutPg)! Conteudo do TOP não encontrado!</p>";
        }  ?>
    </div>
    <?php var_dump($this->data); ?>
</div>