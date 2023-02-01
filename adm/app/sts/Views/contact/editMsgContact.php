<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} // var_dump($this->data['form'][0]); ?>
<!-- <span id="msg"></span> -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Mensagem (Pg Contatos)</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); } 
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-msg-contact">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="row_edit">
                <label class="" for="name">Titulo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Altere o nome da Msg" required>
            </div>
            <div class="row_edit">
                <label class="" for="email">E-mail:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>" placeholder="Alterar o e-mail">
            </div>
            <div class="row_edit">
                <label class="" for="subject">Assunto:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="subject" id="subject" value="<?php if(isset($valorForm['subject'])){echo $valorForm['subject'];} ?>" placeholder="Altere o Assunto da Msg" required>
            </div>
            <div class="row_edit">
                <label class="" for="content">Conteúdo Msg:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="content" id="content" value="<?php if(isset($valorForm['content'])){echo $valorForm['content'];} ?>" placeholder="Altere o Conteúdo da Msg" required>
            </div>
            
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditMsgContact" value="Salvar">Salvar Alterações</button><br>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-success mx-2" href="<?=URLADM;?>list-msg-contact/index">Listar Artigos</a>
                 <?php if(isset($valorForm['id'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-msg-contact/index/".$valorForm['id']."'> Visualizar </a>";
                    echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-msg-contact/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar</a>"; } ?>
            </div>
        </form>
    </div>
</div>



