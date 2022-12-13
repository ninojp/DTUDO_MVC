<?php
// echo "Views/users/viewUser.php <h1> Pagina(view) para vizualizar os usuários</h1>";
// var_dump($this->data);
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
echo "<h1>Detalhes do Usuário</h1>";
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-users/index'> Listar Usuários</a> ";
if(!empty($this->data['viewUsers'])){
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-users/index/".$this->data['viewUsers'][0]['id']."'> Editar Usuário</a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-users-password/index/".$this->data['viewUsers'][0]['id']."'> Editar Senha </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-users-image/index/".$this->data['viewUsers'][0]['id']."'> Editar Imagem</a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-users/index/".$this->data['viewUsers'][0]['id']."'> Apagar Usuário</a><br><hr>";
}
if(!empty($this->data['viewUsers'])){
    // var_dump($this->data['viewUsers'][0]);
    extract($this->data['viewUsers'][0]);
    echo "ID: $id <br>";
    echo "Nome: $name_usr <br>";
    echo "E-mail: $email <br>";
    echo "Nickname: $nickname <br>";
    echo "user: $user <br>";
    echo "Situação do usuário: $adms_sits_user_id = $name_sit <br>";
    echo "Cor da Situação: <span style='background-color:$color_col;'> $name_col = $color_col </span><br>";
    echo "image: $image <br>";
    echo "Created: ".date('d/m/Y H:i;s', strtotime($created))."<br>";
    echo "Modified: ";
    if(!empty($modified)){
        echo date('d/m/Y H:i;s', strtotime($modified))."<br><hr>";
    }
}