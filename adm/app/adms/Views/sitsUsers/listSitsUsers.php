<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

echo "<h1>Lista de Situações do usuário</h1>";
// var_dump($this->data['listSitsUsers']);
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-sits-users/index'> Adicionar </a><br>";
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

foreach($this->data['listSitsUsers'] as $listSits){
    // var_dump($listSits);
    extract($listSits);
    echo "ID: $id<br>";
    echo "Situação e Cor: <span style='color:$color;'> $sitsname</span><br><br>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-sits-users/index/$id'> Visualizar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-sits-users/index/$id'> Editar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-sits-users/index/$id'> Apagar </a><br><hr>";
}
//imprime os links de paginação
echo $this->data['pagination'];