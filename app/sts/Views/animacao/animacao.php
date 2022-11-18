<?php
if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
echo '<h1>VIEW! da página ANIMAÇÃO!!!</h1>';

// var_dump($this->data['about-company']);
//======================================================
/////////  NO CURSO ESTA É A VIEW SOBREEMPRESA   ///////
//======================================================

//acessa o if quando encontrou algum registro no DB
if(!empty($this->data['about-company'])){
    foreach($this->data['about-company'] as $about_company){
        extract($about_company);
        echo "Id da compania: $id<br>";
        echo "Titulo da compania: $title<br>";
        echo "Descrição da compania: $description<br>";
        echo "Imagem (nome apenas): $image<br>";
        echo "<hr>";
    }
}else{
    echo "<p class='alert alert-danger'>Erro! Nenhum registro encontrado</p>";
}