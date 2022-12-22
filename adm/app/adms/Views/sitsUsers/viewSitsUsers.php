<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

echo "<h1>Detalhes da Situação</h1>";
// var_dump($this->data['viewSitsUsers'][0]);
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-sits-users/index'> Listar </a><br><hr>";
// if(!empty($this->data['viewSitsUsers'])){
//     extract($this->data['viewSitsUsers'][0]);
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-sits-users/index/$id'> Editar </a>";
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-sits-users/index/$id'> Apagar </a><br><hr>";
// }
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
if(!empty($this->data['viewSitsUsers'])){
    extract($this->data['viewSitsUsers'][0]);
    echo "ID: $id<br>";
    echo "Situação: $sitsname<br>";
    echo "Cor Situação:<span style='background-color:$color;color:#fff;'> $colname</span><br>";
    echo "Situação criada: ". date('d/m/Y H:i:s', strtotime($created)) ."<br>";
    if(!empty($modified)){
        echo "Situação Modificada:". date('d/m/Y H:i:s', strtotime($modified)) ."<br>";
    }
    echo "<br>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-sits-users/index/$id'> Editar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-sits-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
}