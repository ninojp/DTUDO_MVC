<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

// echo "<h1>Listar Cores</h1>";
// // var_dump($this->data['listColors']);
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-colors/index'> Adicionar </a><br>";
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }

// foreach($this->data['listColors'] as $colorList){
//     // var_dump($colorList);
//     extract($colorList);
//     echo "ID: $id<br>";
//     echo "Nome da Cor: <span style='background-color:$color;color:#fff;'> $name</span><br><br>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-colors/index/$id'> Visualizar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-colors/index/$id'> Editar </a>";
//     echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-colors/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
// }
// //imprime os links de paginação
// echo $this->data['pagination']; ?>

<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper">
    <div class="row">
        <div class="top_list">
            <span class="title_content">
                <h2>Listar Cores</h2>
            </span>
            <!-- Mensagens de avisos -->
            <?php if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']); }?>
            <div class="top_list_right">
                <a class="btn btn-sm btn_success" href="<?= URLADM.'add-colors/index';?>" type="button">Cadastrar</a>
            </div>
        </div>
        <table class="table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome da Cor</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">Codigo da Cor</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listColors'] as $colorList) { extract($colorList);  ?>
                <tr>
                    <td class="list_body_content"><?=$id;?></td>
                    <td class="list_body_content"><span style='background-color:<?=$color?>;color:#fff;'><?=$name?></span></td>
                    <td class="list_body_content tb_sm_none"><span style='color:<?=$color;?>'><?=$color;?></span></td>
                    <td class="list_body_content">
                        <?php echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-colors/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>"; 
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-colors/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-colors/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
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