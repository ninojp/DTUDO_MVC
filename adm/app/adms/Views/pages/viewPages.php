<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes da Pagina</h2>
        </div>
    <?php if (!empty($this->data['viewPages'])) {
        extract($this->data['viewPages'][0]); 
        if (isset($_SESSION['msg'])) { 
        echo "<div class='msg_alert'>";
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        echo "</div>"; }    ?>
        <div id='msg' class='msg_alert'></div>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome da Página:</span>
                <span class="view_det_info"><?= $name_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Controller:</span>
                <span class="view_det_info"><?= $controller; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Método:</span>
                <span class="view_det_info"><?= $metodo; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">menu_controller:</span>
                <span class="view_det_info"><?= $menu_controller; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">menu_metodo:</span>
                <span class="view_det_info"><?= $menu_metodo; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">publish:</span>
                <span class="view_det_info"><?= $publish; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">adms_sits_pgs_id:</span>
                <span class="view_det_info"><?= $name_asp; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">adms_types_pgs_id:</span>
                <span class="view_det_info"><?= $type_atp; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">adms_groups_pgs_id:</span>
                <span class="view_det_info"><?= $name_agp; ?></span>
            </div>
            <?php if (!empty($obs)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Observações:</span>
                    <span class="view_det_info"><?= $obs; ?></span>
                </div>
            <?php } ?>
            <?php if (!empty($icon)) { ?>
                <div class="view_det">
                    <span class="view_det_title">icon:</span>
                    <span class="view_det_info"><?= $icon; ?></span>
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
            <a class="btn btn-sm btn-outline-success mx-1" href="<?= URLADM; ?>list-pages/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a>
            <?php if($this->data['button']['edit_pages']) { ?>
                <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>edit-pages/index/<?= $id; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a> <?php } ?>
            <?php if($this->data['button']['delete_pages']) { ?>
            <a class="btn btn-sm btn-outline-danger mx-1" href="<?= URLADM; ?>delete-pages/index/<?= $id; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a><?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->