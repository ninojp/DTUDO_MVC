<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Item <br>do Menu DropDown</h2>
        </div>
        <?php echo "<div class='msg_alert'>";
                if (isset($_SESSION['msg'])) { 
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); }
                echo "</div>";
        if (!empty($this->data['viewItensMenu'])) {
            extract($this->data['viewItensMenu'][0]); ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome no menu:</span>
                <span class="view_det_info"><?= $name; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Icon (class):</span>
                <span class="view_det_info"><i class="<?= $icon; ?>"> </i> - <?= $icon; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Ordem do Item:</span>
                <span class="view_det_info"><?= $order_item_menu; ?></span>
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
            <a class="btn btn-sm btn-outline-success mx-1" href="<?= URLADM; ?>list-itens-menu/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a>
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>edit-itens-menu/index/<?= $id; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
            <a class="btn btn-sm btn-outline-danger mx-1" href="<?= URLADM; ?>delete-itens-menu/index/<?= $id; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->