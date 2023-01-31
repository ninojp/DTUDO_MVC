<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<div class="wrapper_form">
    <div class="row_form_sts">
        <h1 class="col-12 m-4">Pagina de Contato</h1>
        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
        </div>
        <div class="title_form">
            <span class="title_content">Editar os dados da Página contato</span>
            <div class="top-list-right">
                <?php if (!empty($this->data['viewPgContact'])) {
                    echo "<a href='" . URLADM . "edit-pg-contact/index' class='btn btn-warning ms-3'>Editar Dados</a>";
                } ?>
            </div>
        </div>
        <div class="content-adm">
            <?php if (!empty($this->data['viewPgContact'])) {
                extract($this->data['viewPgContact'][0]); ?>
                <div class="view-det-adm">
                    <span class="view-det-title">ID:</span>
                    <span class="view-det-info"><?= $id; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">title_contact: </span>
                    <span class="view-det-info"><?= $title_contact; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">desc_contact:</span>
                    <span class="view-det-info"><?= $desc_contact; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">icon_company:</span>
                    <span class="view-det-info"><i class="<?= $icon_company; ?>"></i></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">title_company:</span>
                    <span class="view-det-info"><?= $title_company; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">desc_company:</span>
                    <span class="view-det-info"><?= $desc_company; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">icon_address:</span>
                    <span class="view-det-info"><i class="<?= $icon_address; ?>"></i></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">title_address:</span>
                    <span class="view-det-info"><?= $title_address; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">desc_address:</span>
                    <span class="view-det-info"><?= $desc_address; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">icon_email:</span>
                    <span class="view-det-info"><i class="<?= $icon_email; ?>"></i></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">title_form:</span>
                    <span class="view-det-info"><?= $title_form; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">desc_email:</span>
                    <span class="view-det-info"><?= $desc_email; ?></span>
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
                echo "<p class='alert alert-danger'>Erro (viewPgContact)! Dados de Contato não encontrado!</p>";
            }  ?>
   </div>
</div>