<?php
// echo "Views/users/viewUser.php <h1> Pagina(view) para vizualizar os usuários</h1>";
// var_dump($this->data);
echo "<h1>Perfil</h1>";

if (!empty($this->data['viewProfile'])) {
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-profile/index'> Editar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-profile-password/index'> Editar Senha</a><hr>";
    
}
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
if (!empty($this->data['viewProfile'])) {
    // var_dump($this->data['viewProfile'][0]);
    extract($this->data['viewProfile'][0]);
    if ((!empty($image)) and (file_exists("app/adms/assets/imgs/users/" . $_SESSION['user_id'] . "/$image"))) {
        echo "<img src='" . URLADM . "app/adms/assets/imgs/users/" . $_SESSION['user_id'] . "/$image' width='200' height='200'><br><br>";
    } else {
        echo "<img src='" . URLADM . "app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png' width='300' height='100'><br><br>";
    }
    echo "Nome: $name <br>";
    echo "Nickname: $nickname <br>";
    echo "E-mail: $email <br><hr>";
}
