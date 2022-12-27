<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// var_dump($this->data);
// var_dump($this->data['listUsers']);
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='" . URLADM . "add-users/index'>Cadastrar Usuário</a><br><hr>";
// if (isset($_SESSION['msg'])) {
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }
// foreach ($this->data['listUsers'] as $user) {
//     // var_dump($user);
//     extract($user);
//     echo "ID: $id <br>";
//     echo "Nome: $name_usr<br>";
//     echo "E-Mail: $email<br>";
//     echo "Situação e id: $name_sit (id: $adms_sits_user_id)<br>";
//     echo "Cor da Situação: <span style='background-color:$color;'> $name_col</span><br>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='" . URLADM . "view-users/index/$id'> Visualizar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='" . URLADM . "edit-users/index/$id'> Editar </a>";
//     echo "<a class='btn btn-sm btn-outline-danger ms-4' href='" . URLADM . "delete-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
//    
//     <!-- Outra forma de usar o alerta de confirmação, o resultado é o mesmo -->
//     <a class='btn btn-sm btn-outline-danger ms-4' href="<?=URLADM.'delete-users/index/'.$id;" onclick="return confirm('Tem certeza que deseja excluir o registro?')"> Apagar </a><br><hr>
//     <?php 
// } ?>

<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper">
    <div class="row">
        <div class="top_list">
            <span class="title_content">
                <h2>Listar Usuários</h2>
            </span>
            <div class="top_list_right">
                <a class="btn btn-sm btn_success" href="<?= URLADM.'add-users/index';?>" type="button">Cadastrar</a>
            </div>
        </div>
        <span class="espaco_alert"></span>
            <!-- Mensagens de avisos -->
            <?php if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); }?>
        </span>
        <table class="table_list">
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
                        <?php echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-users/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>"; 
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-users/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                        ?>
                    </td>
                </tr>
                <?php } ?>
                <!-- Exemplo com o botão unico com menu DropDown ------------------------------->
                <!-- <tr>
                    <td class="list_body_content">3</td>
                    <td class="list_body_content">Cesar3</td>
                    <td class="list_body_content tb_sm_none">cesar3@celk.com.br</td>
                    <td class="list_body_content tb_sm_none">Coluna01</td>
                    <td class="list_body_content">
                        <div class="drop_action">
                            <button class="drop_btn_action" onclick="actionDrop($id)">Ação</button>
                            <div id="actionDrop$id" class="drop_action_item">
                                <a href="#">Vizualizar 1</a>
                                <a href="formulario_dash.php">Editar</a>
                                <a href="#">Apagar</a>
                            </div>
                        </div>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>