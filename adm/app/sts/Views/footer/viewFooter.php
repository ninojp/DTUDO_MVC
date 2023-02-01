<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<div class="wrapper_form">
    <div class="row_form_sts">
        <h1 class="col-12 m-4">Rodapé - Footer</h1>
        <div id='msg' class='msg_alert'>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
        </div>
        <div class="title_form">
            <span class="title_content">Editar os dados do Rodapé</span>
            <div class="top-list-right">
                <?php if (!empty($this->data['viewFooter'])) {
                    echo "<a href='" . URLADM . "edit-footer/index' class='btn btn-warning ms-3'>Editar Dados</a>";
                } ?>
            </div>
        </div>
        <div class="content-adm">
            <?php if (!empty($this->data['viewFooter'])) {
                extract($this->data['viewFooter'][0]); ?>
                <div class="view-det-adm">
                    <span class="view-det-title">ID:</span>
                    <span class="view-det-info"><?= $id; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">footer_desc: </span>
                    <span class="view-det-info"><?= $footer_desc; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">footer_text_link:</span>
                    <span class="view-det-info"><?= $footer_text_link; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">footer_link:</span>
                    <span class="view-det-info"><i class="<?= $footer_link; ?>"></i></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">Data Criação:</span>
                    <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($created)); ?></span>
                </div>
                <?php if (!empty($modified)) { ?>
                    <div class="view-det-adm">
                        <span class="view-det-title">Modificado:</span>
                        <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($modified)); ?></span>
                    </div> <?php } ?>
        </div>
        <?php } else {
                echo "<p class='alert alert-danger'>Erro (viewFooter)! Dados de Contato não encontrado!</p>";
            }  ?>
   </div>
</div>