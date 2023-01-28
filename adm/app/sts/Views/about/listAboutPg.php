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
                <h2 class="title_h2">Listar Artigos - Sobre Empresa</h2>
            </div>
            <div class="div_row_msg_btn">
                <div class="col-9 msg_alert">
                    <!-- Mensagens de avisos -->
                    <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); } ?>
                </div>
                <?php if($this->data['button']['add_users']) {?>
                    <div class="col-3 top_list_right">
                        <a class="btn btn-sm btn_success" href="<?= URLADM.'add-users/index';?>" type="button">Cadastrar Artigo</a>
                    </div>
                <?php }?>
            </div>
            <!-- DIV com o campo de pesquisa -->
            <div class="div_row_form">
                <form class="form_pesquisar" action="" name="form_pesquisar" method="POST">
                    <div class="row_form_pesquisar">
                        <div class="col-4">
                            <?php $title = "";
                            if (isset($valorForm['title'])) {
                                $title = $valorForm['title'];
                            } ?>
                            <label for="title">Titulo: </label>
                            <input type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Pesquisar pelo nome">
                        </div>
                        <div class="col-3">
                            <button  class="btn btn-sm btn-outline-info" type="submit" name="SendSearchTitle" value="Pesquisar">Pesquisar pelo Título</button>
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
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">E-mail</th>
                    <th class="list_head_content tb_sm_none">Situação Cadastral</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listUsers'] as $user) { extract($user);  ?>
                <tr>
                    <td class="list_body_content"><?=$id;?></td>
                    <td class="list_body_content"><?=$name_usr;?></td>
                    <td class="list_body_content tb_sm_none"><?=$email;?></td>
                    <td class="list_body_content tb_sm_none"><span style='color:<?=$color;?>'><?=$name_sit;?></span></td>
                    <td class="list_body_content">
                        <?php if($this->data['button']['view_users']) {
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-users/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                        if($this->data['button']['edit_users']) {
                            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-users/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                        if($this->data['button']['delete_users']) {
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } ?>
                    </td>
                </tr>
                <?php } ?>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>