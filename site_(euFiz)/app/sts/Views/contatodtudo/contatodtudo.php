<?php
if (!defined('C7E3L8K9E5')) {
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die('Erro! Página não encontrada');
} 
if (isset($this->data)) {
    $valuesForm = $this->data['form'];
    extract($valuesForm);
} ?>
<h1 class="text-center m-5">VIEW! da página CONTATO DTUDO!!!</h1>
<?php
if(isset($_SESSION['msg'])){
   echo $_SESSION['msg'];
   unset($_SESSION['msg']);
}
//======================================================
/////////  NO CURSO ESTA É A CONTROLER CONTATO   ///////
//====================================================== 
?>
<div class="conatiner p-5">
    <div class="row">
        <div class="col-6">
            <form name="formData" action="" method="POST">
                <!--Devido ao problema na FORMATAÇÃO automática do VS, poderia ser feito assim:
                $value_nome = '';
                if (isset($nome)) {
                    $value_nome = $nome; } -->
                <div class="col mb-3">
                    <label class="form-label" for="nome">Nome:</label>
                    <input class="form-control" type="text" name="nome" id="nome" placeholder="Insira seu nome" value="<?php if(isset($nome)) {echo $nome;}?>">
                </div>
                <div class="col mb-3">
                    <label class="form-label" for="email">Email:</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Insira seu Email" value="<?php if(isset($email)) {echo $email;}?>">
                </div>
                <div class="col mb-3">
                    <label class="form-label" for="assunto">Assunto:</label>
                    <input class="form-control" type="text" name="assunto" id="assunto" placeholder="Assunto da mensagem" value="<?php if(isset($assunto)) {echo $assunto;}?>">
                </div>
                <div class="col mb-3">
                    <label class="form-label" for="content">Menssagem:</label>
                    <textarea class="form-control" rows="6" cols="50" name="content" id="content" placeholder="Conteudo da mensagem"><?php if(isset($content)) {echo $content;}?></textarea>
                </div>
                <input class="btn btn-sm btn-outline-info" name="addContMsg" type="submit" value="Enviar Dados">
            </form>
        </div>
    </div>
</div>