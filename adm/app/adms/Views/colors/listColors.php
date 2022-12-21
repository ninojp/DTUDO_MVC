<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

echo "<h1>Listar Cores</h1>";
// var_dump($this->data['listColors']);
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."add-colors/index'> Adicionar </a><br>";
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

foreach($this->data['listColors'] as $color){
    // var_dump($color);
    extract($color);
    echo "ID: $id<br>";
    echo "Nome da Cor: <span style='background-color:$color;color:#fff;'> $name</span><br><br>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-colors/index/$id'> Visualizar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-colors/index/$id'> Editar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."delete-colors/index/$id'> Apagar </a><br><hr>";
}
//imprime os links de paginação
echo $this->data['pagination'];