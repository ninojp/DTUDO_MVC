<?php
if(!defined('C7E3L8K9E5')){
    // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
echo '<h1>VIEW! Página INICIAL do site Dtudo!!!</h1><br>';
// var_dump($this->data[0]);
// echo "ID Anime: {$this->data['id_anime']}<br>";
// echo "Nome_anime: {$this->data['nome_anime']}<br>";
if(!empty($this->data[0])){
    //USANDO o EXTRACT
    extract($this->data[0]);
    echo "ID Anime: $id_anime<br>";
    echo "Nome_anime: $nome_anime<br>";
    echo "Nome_completo_anime: $nome_completo_anime<br>";
    echo "Descricao_anime: $descricao_anime<br>";
    echo "Img_mini: $img_mini<br>";
}else{
    echo "<p class='alert alert-danger'>Erro! Nenhum Registro encontrado!</p>";
}
//testar o acesso direto ao arquivo
// https://localhost/DTUDO_MVC/app/sts/Views/dtudo/dtudo.php