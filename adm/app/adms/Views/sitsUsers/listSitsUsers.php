<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

echo "<h1>View da pagina listar Situações do usuário</h1>";
// var_dump($this->data['listSitsUsers']);

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

foreach($this->data['listSitsUsers'] as $listSits){
    // var_dump($listSits);
    extract($listSits);
    echo "ID: $id<br>";
    echo "Situação e Cor: <span style='background-color:$color;'> $sitsname</span><br>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-users/index/$id'> Visualizar </a><br><hr>";
}