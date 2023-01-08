<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); } ?>
<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="col-12 title_content">
                <h2 class="title_h2">Grupos de Paginas</h2>
            </div>
            <div class="row mb-2">
                <div class='col-9 msg_alert'>
                    <?php if (isset($_SESSION['msg'])) { 
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']); } ?>
                </div>
                <div class="col-3 top_list_right">
                    <a class="btn btn-sm btn_success" href="<?= URLADM.'add-groups-pgs/index';?>" type="button">Cadastrar Grupo Pg</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome do Grupo</th>
                    <th class="list_head_content tb_sm_none">order_group_pg</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listGroupsPgs'] as $groupsPgs) { extract($groupsPgs);  ?>
                <tr>
                    <td class="list_body_content"><?=$id;?></td>
                    <td class="list_body_content"><?=$name;?></td>
                    <td class="list_body_content tb_sm_none"><?=$order_group_pg;?></td>
                    <td class="list_body_content">
                        <?php 
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."order-groups-pgs/index/$id?pag=".$this->data['pag']."'><i class='fa-solid fa-arrow-up-short-wide'></i> Ordem</a>";
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-groups-pgs/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>"; 
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-groups-pgs/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-groups-pgs/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                        ?>
                    </td>
                </tr>  <?php } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination'];  ?>
    </div>
</div>