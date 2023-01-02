<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>

<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="title_content">
                <h2 class="title_h2">Listar Niveis de acesso</h2>
            </div>
            <div class="div_row_msg_btn">
                <div class="col-9 msg_alert">
                    <!-- Mensagens de avisos -->
                    <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); } ?>
                </div>
                <div class="col-3 top_list_right">
                    <a class="btn btn-sm btn_success" href="<?= URLADM.'add-access-nivels/index';?>" type="button">Cadastrar Nivel de acesso</a>
                </div>
            </div>
            <!-- DIV com o campo de pesquisa -->
            <div class="div_row_form">
                <form class="form_pesquisar" action="" name="form_pesquisar" method="POST">
                    <div class="row_form_pesquisar">
                        <div class="col-4">
                            <?php $search_name = "";
                            if (isset($valorForm['search_name'])) {
                                $search_name = $valorForm['search_name'];
                            } ?>
                            <label class="">Nome: </label>
                            <input type="text" name="search_name" id="seach_name" value="<?php echo $search_name; ?>" placeholder="Pesquisar pelo nome">
                        </div>
                        <div class="col-3">
                            <button  class="btn btn-sm btn-outline-info" type="submit" name="SendSearchAccessNivels" value="Pesquisar">Pesquisar por nome ou Nivel</button>
                        </div>
                        <div class="col-4">
                            <?php $search_access_nivels = "";
                            if (isset($valorForm['search_access_nivels'])) {
                                $search_access_nivels = $valorForm['search_access_nivels'];
                            } ?>
                            <label class="">Nivel de Acesso: </label>
                            <input type="text" name="search_access_nivels" id="search_access_nivels" value="<?= $search_access_nivels; ?>" placeholder="Pesquisar pelo Nivel de acesso">
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
                    <th class="list_head_content tb_sm_none">Nivel de Acesso</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <?php
            // var_dump($this->data['listAccessNivels']);
            ?>
            <tbody class="list_body">
                <?php foreach ($this->data['listAccessNivels'] as $AccessNivels) { extract($AccessNivels); ?>
                <tr>
                    <td class="list_body_content"><?=$id;?></td>
                    <td class="list_body_content"><?=$name;?></td>
                    <td class="list_body_content tb_sm_none"><?=$order_levels;?></td>
                    <td class="list_body_content">
                        <?php echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-access-nivels/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>"; 
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-access-nivels/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-access-nivels/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>