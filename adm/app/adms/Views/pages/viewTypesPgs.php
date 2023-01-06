<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Tipo de pagina</h2>
        </div>
    <?php if (!empty($this->data['viewTypesPgs'])) {
        extract($this->data['viewTypesPgs'][0]); 
        if (isset($_SESSION['msg'])) { 
        echo "<div id='msg' class='msg_alert'>";
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        echo "</div>"; }
    ?>
        <div id='msg' class='msg_alert'></div>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Tipo:</span>
                <span class="view_det_info"><?= $type; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome do Tipo:</span>
                <span class="view_det_info"><?= $name; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">order_type_pg:</span>
                <span class="view_det_info"><?= $order_type_pg; ?></span>
            </div>
            <?php if (!empty($obs)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Observações:</span>
                    <span class="view_det_info"><?= $obs; ?></span>
                </div>
            <?php } ?>
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
            <a class="btn btn-sm btn-outline-success mx-1" href="<?= URLADM; ?>list-types-pgs/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a>
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>edit-types-pgs/index/<?= $id; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
            <a class="btn btn-sm btn-outline-danger mx-1" href="<?= URLADM; ?>delete-types-pgss/index/<?= $id; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->