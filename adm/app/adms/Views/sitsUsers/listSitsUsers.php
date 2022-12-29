<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "<h1>Lista de Situações do usuário</h1>";
// var_dump($this->data['listSitsUsers']);
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-sits-users/index'> Adicionar </a><br>";
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }
// foreach($this->data['listSitsUsers'] as $listSits){
//     // var_dump($listSits);
//     extract($listSits);
//     echo "ID: $id<br>";
//     echo "Situação e Cor: <span style='color:$color;'> $sitsname</span><br><br>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-sits-users/index/$id'> Visualizar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-sits-users/index/$id'> Editar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-sits-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
// }
// //imprime os links de paginação
// echo $this->data['pagination']; ?>

<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <span class="title_content">
                <h2 class="title_h2">Listar Situações do Usuário</h2>
            </span>
            <div class="top_list_right">
                <a class="btn btn-sm btn_success" href="<?= URLADM.'add-sits-users/index';?>" type="button">Cadastrar</a>
            </div>
            <div class="msg_alert">
                <!-- Mensagens de avisos -->
                <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); }?>
            </div>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome da Situação</th>
                    <th class="list_head_content tb_sm_none">Cor Situação</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listSitsUsers'] as $listSits) { extract($listSits);  ?>
                <tr>
                    <td class="list_body_content"><?=$id;?></td>
                    <td class="list_body_content"><?=$sitsname;?></td>
                    <td class="list_body_content tb_sm_none"><span style='color:<?=$color;?>'><?=$colname;?></span></td>
                    <td class="list_body_content">
                        <?php echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-sits-users/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>"; 
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-sits-users/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-sits-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                        ?>
                    </td>
                </tr>  <?php } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination'];  ?>
    </div>
</div>