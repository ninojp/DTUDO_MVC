<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/users/viewEmailConfs.php <h1> Pagina(view) para vizualizar as Configurações do E-mail</h1>";
// var_dump($this->data);
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
echo "<h1>Detalhes da Configuração do E-mail</h1>";
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-email-confs/index'> Listar </a>";
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-email-confs/index'>Cadastrar E-mail</a><br><hr>";
if(!empty($this->data['viewEmailConf'])){
    // var_dump($this->data['viewEmailConf']);
    extract($this->data['viewEmailConf'][0]);
    echo "ID: $id <br>";
    echo "E-mail: $email <br>";
    echo "Nome: $name <br>";
    echo "Titulo: $title <br>";
    echo "Host: $host <br>";
    echo "Username: $username <br>";
    echo "smtpsecure: $smtpsecure<br>";
    echo "port: $port<br>";
    echo "Created: ".date('d/m/Y H:i:s', strtotime($created))."<br>";
    if(!empty($modified)){ echo "Modified: ".date('d/m/Y H:i:s', strtotime($modified)); }
    echo "<br><br>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-email-confs/index/$id'> Editar</a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-email-confs-pass/index/$id'> Editar Senha </a>";
    echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-email-confs/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
}