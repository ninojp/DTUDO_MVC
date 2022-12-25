<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/users/Pagina(listEmailConfs.php) <h1>Listar E-mails</h1>";
// // var_dump($this->data);
// // var_dump($this->data['listEmails']);
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-email-confs/index'>Cadastrar E-mail</a><br><hr>";
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }
// foreach($this->data['listEmails'] as $emails){
//     // var_dump($emails);
//     // posso otimizar com o EXTRACT, para usar a CHAVE do array, como uma variável 
//     extract($emails);
//     echo "ID: $id <br>";
//     echo "E-mail: $email<br>";
//     echo "Titulo: $title<br>";
//     echo "Name: $name<br>";
//     echo "Host: $host<br>";
//     echo "username: $username<br>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-email-confs/index/$id'> Visualizar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-email-confs/index/$id'> Editar </a>";
//     echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-email-confs/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
// }
// //imprime os links de paginação
// echo $this->data['pagination']; ?>

<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper">
    <div class="row">
        <div class="top_list">
            <span class="title_content">
                <h2>Listar Configurações de E-mail</h2>
            </span>
            <!-- Mensagens de avisos -->
            <?php if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']); }?>
            <div class="top_list_right">
                <a class="btn btn-sm btn_success" href="<?= URLADM.'add-users/index';?>" type="button">Cadastrar</a>
            </div>
        </div>
        <table class="table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Titulo</th>
                    <th class="list_head_content">Nome</th>
                    <th class="list_head_content">E-mail</th>
                    <th class="list_head_content tb_sm_none">Host</th>
                    <th class="list_head_content tb_sm_none">UserName</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listEmails'] as $emails) { extract($emails);  ?>
                <tr>
                    <td class="list_body_content"><?=$id;?></td>
                    <td class="list_body_content"><?=$title;?></td>
                    <td class="list_body_content"><?=$name;?></td>
                    <td class="list_body_content"><?=$email;?></td>
                    <td class="list_body_content tb_sm_none"><?=$host;?></td>
                    <td class="list_body_content tb_sm_none"><?=$username;?></td>
                    <td class="list_body_content">
                        <?php echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-email-confs/index/$id'><i class='fa-solid fa-eye'></i> Ver</a>"; 
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-email-confs/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-email-confs/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                        ?>
                    </td>
                </tr>
                <?php } ?>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>
