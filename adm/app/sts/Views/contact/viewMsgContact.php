<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Visualizar Detalhes da Mensagem</h2>
        </div>
        <div id='msg' class='msg_alert'>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
        </div>
        <div class="content_adm">
            <?php if (!empty($this->data['viewMsgContact'])) {
                extract($this->data['viewMsgContact'][0]); ?>
                <div class="view_det">
                    <span class="view_det_title">ID:</span>
                    <span class="view_det_info"><?= $id; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">name:</span>
                    <span class="view_det_info"><?= $name; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">E-mail:</span>
                    <span class="view_det_info"><?= $email; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Assunto:</span>
                    <span class="view_det_info"><?= $subject; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Conteúdo:</span>
                    <span class="view_det_info"><?= $content; ?></span>
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
                <?php if (!empty($this->data['viewMsgContact'])) {
                    echo "<a href='" . URLADM . "list-msg-contact/index' class='btn btn-sm btn-info ms-3'>Listar</a>";
                    echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-msg-contact/index/".$this->data['viewMsgContact'][0]['id']."'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";

                    echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-msg-contact/index/".$this->data['viewMsgContact'][0]['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                } ?>
            </div>
        <?php } else {
                echo "<p class='alert alert-danger'>Erro (viewMsgContact)! Mensagem não encontrado!</p>";
        }  ?>
    </div>
</div>