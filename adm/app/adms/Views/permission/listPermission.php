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
                <h2 class="title_h2">Listar Permissões do nivel de acesso <?= $this->data['viewAccessLevel'][0]['name']; ?></h2>
            </div>
            <div class="div_row_msg_btn">
                <div class="col-9 msg_alert">
                    <!-- Mensagens de avisos -->
                    <?php if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    } ?>
                </div>
                <div class="col-3 top_list_right mb-2">
                    <?php if($this->data['button']['list_access_nivels']){
                    echo "<a class='btn btn-sm btn_info' href='" .URLADM . "list-access-nivels/index' type='button'>Listar Niveis de acesso</a>"; } ?>
                </div>
            </div>

        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome da Página</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">Ordenar</th>
                    <th class="list_head_content tb_sm_none">Permissão</th>
                    <th class="list_head_content tb_sm_none">Menu</th>
                    <th class="list_head_content tb_sm_none">DropDown</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <?php
            // var_dump($this->data['listAccessNivels']);
            ?>
            <tbody class="list_body">
                <?php foreach ($this->data['listPermission'] as $permission) {
                    extract($permission); ?>
                    <tr>
                        <td class="list_body_content"><?= $id; ?></td>
                        <td class="list_body_content"><?= $name_page; ?></td>
                        <!-- ORDENAR - apresenta o numero de ordem da página (order_level_page) -->
                        <td class="list_body_content tb_sm_none"><?= $order_level_page; ?></td>
                        <!-- PERMISSÃO - Permitir ou bloquear acesso ao nivel(access_level) -->
                        <td class="list_body_content tb_sm_none">
                            <?php if ($permission == 1) {
                                echo "<a href='" . URLADM . "edit-permission/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='text-success'>Liberado</span></a>";
                            } else {
                                echo "<a href='" . URLADM . "edit-permission/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='text-danger'>Bloqueado</span></a>";
                            }
                        echo "</td>";
                        // MENU - Exibir ou ocultar, listar o nome da pagina no menu lateral Sidebar(não Dropdown)
                        echo "<td class='list_body_content tb_sm_none'>";
                            if ($print_menu == 1) {
                                echo "<a href='" . URLADM . "edit-print-menu/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='text-warning'>Ocultar</span></a>";
                            } else {
                                echo "<a href='" . URLADM . "edit-print-menu/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='text-info'>Exibir</span></a>";
                            } 
                        echo "</td>";
                        // MENU DROPDOWN - SIM é um item de menu Dropdown
                        echo "<td class='list_body_content tb_sm_none'>";
                            if ($dropdown == 1) {
                                echo "<a href='" . URLADM . "edit-dropdown-menu/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='text-success'>Sim</span></a>";
                            // MENU DROPDOWN - NÃO é um item no menu Dropdown
                            } else {
                                echo "<a href='" . URLADM . "edit-dropdown-menu/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='text-danger'>Não</span></a>";
                            } 
                        echo "</td>"; ?>
                        <!-- BOTÃO Ordem - ordenar as paginas -->
                        <td class="list_body_content">
                            <?php  if($this->data['button']['order_page_menu']) {
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "order-page-menu/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><i class='fa-solid fa-arrow-up-short-wide'></i> Ordem</a>"; }
                            // BOTÃO Editar - Edita em qual item(grupo) do menu DropDown, o link da pagina deve ser exibido.
                            if($this->data['button']['edit_page_menu']) {
                            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-page-menu/index/$id?&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
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