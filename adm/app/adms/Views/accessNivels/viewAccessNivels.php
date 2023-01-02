<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Nivel de Acesso</h2>
        </div>
        <div class="pt-3 text-center">
        <?php if (!empty($this->data['viewAccessNivels'])) {
            // var_dump($this->data['viewUsers'][0]);
            extract($this->data['viewAccessNivels'][0]); ?>
        </div>
        <div class="col-12 text-center pb-3">
            <a class="btn btn-sm btn-outline-success mx-4" href="<?= URLADM; ?>list-access-nivels/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome do Nivel:</span>
                <span class="view_det_info"><?= $name; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Codigo do Nivel:</span>
                <span class="view_det_info"><?= $order_levels; ?></span>
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
            <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>edit-access-nivels/index/<?= $id; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
            <a class="btn btn-sm btn-outline-danger mx-2" href="<?= URLADM; ?>delete-access-nivels/index/<?= $id; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->