<?php
echo "Views/users/Pagina(viewUser.php) <h1>Listar Usuários</h1>";
// var_dump($this->data);
// var_dump($this->data['listUsers']);

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
    echo "Nome: $name<br>";
    echo "E-Mail: $email<br><hr>";
}

