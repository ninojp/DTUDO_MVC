<?php
if(!defined('C7E3L8K9E5')){
    // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
echo "<h1 class='text-center'>VIEW! Página INICIAL do site Dtudo!!!</h1>";
// var_dump($this->data);
// die ('Aqui! na View Dtudo');
// echo "ID Anime: {$this->data[0]['id']}<br>";
// echo "Nome_anime: {$this->data[0]['nome']}<br>";
// echo "Email: {$this->data[0]['email']}<br>";
// echo "Assunto: {$this->data[0]['assunto']}<br>";

//==============================================
/////////  NO CURSO ESTA É A VIEW HOME   ///////
//==============================================
?>
<div class="row justify-content-center m-4">
    <div class="col-3"><img src="<?=URL?>app/sts/assets/imgs/Logo_Dtudo_2022-300p.png" alt="Logo"></div>
</div>
<div class="row justify-content-center m-4">
    <div class="col-3"><img src="<?=URL?>app/sts/assets/imgs/terra_250px.png" alt="Terra"></div>
    <div class="col-2 align-self-center">
        <?php
            if(!empty($this->data)){
                //USANDO o EXTRACT, deu erro depois kkkk
                // extract($this->data);
                // var_dump($this->data);
                echo "ID: {$this->data['0']['id']}<br>";
                echo "Nome: {$this->data['0']['nome']}<br>";
                echo "Email: {$this->data['0']['email']}<br>";
                echo "assunto: {$this->data['0']['assunto']}<br>";
                
            }else{
                echo "<p class='alert alert-danger'>Nenhum Registro encontrado!</p>";
        }?>
    </div>
</div>
<!--
//testar o acesso direto ao arquivo
// https://localhost/DTUDO_MVC/app/sts/Views/dtudo/dtudo.php
-->
