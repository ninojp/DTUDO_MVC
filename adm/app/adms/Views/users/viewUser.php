<?php
// echo "Views/users/viewUser.php <h1> Pagina(view) para vizualizar os usuários</h1>";
// var_dump($this->data);
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
echo "<h1>Detalhes do Usuário</h1>";
if(!empty($this->data['viewUsers'])){
    var_dump($this->data['viewUsers'][0]);
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