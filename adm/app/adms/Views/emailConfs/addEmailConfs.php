<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/emailConfs/addEmailConfs.php<h1> Adicionar novo e-mail de Configuração</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<!-- <h1 class="text-center mt-5">Adicionar E-mail de Configuração</h1> -->
<?php
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-email-confs/index'> Listar </a> ";
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// } ?>
<!-- <span id="msg"></span> -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Adicionar E-mail de Configuração</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <form class="form_adms" action="" method="POST" id="form-add-email-confs">
            <div class="row_input">
                <?php $email="";
                if(isset($valorForm['email'])) {
                $email=$valorForm['email'];} ?>
                <!-- <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?=$email;?>" placeholder="Digite o Email *" required>
            </div>
            <div class="row_input">
                <?php $username="";
                if(isset($valorForm['username'])) {
                $username = $valorForm['username'];} ?>
                <!-- <label class="form-label" for="username">username:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Digite o nome do usuário (login) *" required>
            </div>
            <div class="row_input">
                <?php $password ="";
                if(isset($valorForm['password'])) {
                $password = $valorForm['password'];} ?>
                <!-- <label class="form-label" for="password">Senha:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="password" id="password" onkeyup="passwordStrength()" autocomplete="on" value="<?= $password; ?>" placeholder="Digite a Senha do E-mail (login) *" required>
            </div>
            <div class="msg_alert" id="msgViewStrength"></div>
            <div class="row_input">
                <?php $title="";
                if(isset($valorForm['title'])){
                $title = $valorForm['title'];} ?>
                <!-- <label class="form-label" for="title">Titulo:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Digite um Titulo *" required>
            </div>
            <div class="row_input">
                <?php $name="";
                if(isset($valorForm['name'])) {
                $name=$valorForm['name'];} ?>
                <!-- <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="name" name="name" id="name" value="<?=$name;?>" placeholder="Digite uma descrição (name) *" required>
            </div>
            <div class="row_input">
                <?php $host="";
                if(isset($valorForm['host'])) {
                $host = $valorForm['host'];} ?>
                <!-- <label class="form-label" for="host">Host:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="host" id="host" value="<?php echo $host; ?>" placeholder="Digite o nome do host *" required>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="row_input">
                <?php $smtpsecure="";
                if(isset($valorForm['smtpsecure'])) {
                $smtpsecure = $valorForm['smtpsecure'];} ?>
                <!-- <label class="form-label" for="smtpsecure">smtpsecure:</label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="smtpsecure" id="smtpsecure" value="<?php echo $smtpsecure; ?>" placeholder="Digite o smtpsecure do host">
            </div>
            <div class="row_input">
                <?php $port=null;
                if(isset($valorForm['port'])) {
                $port = $valorForm['port'];} ?>
                <!-- <label class="form-label" for="port">port:</label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="port" id="port" value="<?php echo $port; ?>" placeholder="Digite o porta se necessário">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddEmailConfs" value="Cadastrar">Cadastrar E-Mail</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-email-confs/index"> Listar  Usuários </a>
            </div>
        </form>
    </div>
</div>



