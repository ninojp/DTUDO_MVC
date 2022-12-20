<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
echo "Views/users/Pagina(listUsers.php) <h1>Listar Usuários</h1>";
// var_dump($this->data);
// var_dump($this->data['listUsers']);


echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-users/index'>Cadastrar Usuário</a><br><hr>";
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
foreach($this->data['listUsers'] as $user){
    // var_dump($user);
    // echo "ID: ".$user['id']."<br>";
    // posso otimizar com o EXTRACT, para usar a CHAVE do array, como uma variável 
    extract($user);
    echo "ID: $id <br>";
    echo "Nome: $name_usr<br>";
    echo "E-Mail: $email<br>";
    echo "Situação e id: $name_sit (id: $adms_sits_user_id)<br>";
    echo "Cor da Situação: <span style='background-color:$color;'> $name_col</span><br>";

    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-users/index/$id'> Visualizar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-users/index/$id'> Editar </a>";
    echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-users/index/$id'> Apagar </a><br><hr>";
}

