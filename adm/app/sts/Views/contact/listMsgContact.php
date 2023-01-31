<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
}?>
<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="title_content">
                <h2 class="title_h2">Listar Mensagens - Página de Contato</h2>
            </div>
            <div class="div_row_msg_btn">
            <div id='msg' class='msg_alert'>
                    <!-- Mensagens de avisos -->
                    <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); } ?>
                </div>
                <div class="col-3 top_list_right">
                    <a class="btn btn-sm btn_success" href="<?= URLADM.'add-msg-contact/index';?>" type="button">Cadastrar Msg</a>
                </div>
            </div>
            <!-- DIV com o campo de pesquisa -->
            <div class="div_row_form">
                <form class="form_pesquisar" action="" name="form_pesquisar" method="POST">
                    <div class="row_form_pesquisar">
                        <div class="col-4">
                            <?php $subject = "";
                            if (isset($valorForm['subject'])) {
                                $subject = $valorForm['subject'];
                            } ?>
                            <label for="subject">Titulo: </label>
                            <input type="text" name="subject" id="subject" value="<?php echo $subject; ?>" placeholder="Pesquisar pelo Assunto">
                        </div>
                        <div class="col-3">
                            <button  class="btn btn-sm btn-outline-info" type="submit" name="SendSearchSubject" value="Pesquisar">Pesquisar pelo Assunto</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome</th>
                    <th class="list_head_content">E-mail</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">Assunto</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listMsgContact'] as $msgContac) { extract($msgContac);  ?>
                <tr>
                    <td class="list_body_content"><?=$id;?></td>
                    <td class="list_body_content"><?=$name;?></td>
                    <td class="list_body_content"><?=$email;?></td>
                    <td class="list_body_content tb_sm_none"><?=$subject;?></td>
                    <td class="list_body_content">
                        <?php
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-msg-contact/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>";

                            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-msg-contact/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";

                            echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-msg-contact/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                        ?>
                    </td>
                </tr>
                <?php } ?>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination'];
        // var_dump($this->data['listAboutPg']);
        // var_dump($this->data['button']);
        ?>
    </div>
</div>