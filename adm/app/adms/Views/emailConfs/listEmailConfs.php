<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
echo "Views/users/Pagina(listEmailConfs.php) <h1>Listar E-mails</h1>";
// var_dump($this->data);
// var_dump($this->data['listEmails']);

echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-email-confs/index'>Cadastrar E-mail</a><br><hr>";
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
foreach($this->data['listEmails'] as $emails){
    // var_dump($emails);
    // posso otimizar com o EXTRACT, para usar a CHAVE do array, como uma variável 
    extract($emails);
    echo "ID: $id <br>";
    echo "E-mail: $email<br>";
    echo "Titulo: $title<br>";
    echo "Name: $name<br>";
    echo "Host: $host<br>";
    echo "username: $username<br>";

    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-email-confs/index/$id'> Visualizar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-email-confs/index/$id'> Editar </a>";
    echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-email-confs/index/$id'> Apagar </a><br><hr>";
}
//imprime os links de paginação
echo $this->data['pagination'];
