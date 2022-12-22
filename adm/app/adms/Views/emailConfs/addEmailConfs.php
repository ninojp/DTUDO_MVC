<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/emailConfs/addEmailConfs.php<h1> Adicionar novo e-mail de Configuração</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<h1 class="text-center mt-5">Adicionar E-mail de Configuração</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-email-confs/index'> Listar </a> ";
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<form action="" method="POST" id="form-add-email-confs">
    <div class="row m-2">
        <div class="col-12 m-2">
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $email="";
                if(isset($valorForm['email'])) {
                $email=$valorForm['email'];} ?>
                <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="email" name="email" id="email" value="<?=$email;?>" placeholder="Digite o Email" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $title="";
                if(isset($valorForm['title'])){
                $title = $valorForm['title'];} ?>
                <label class="form-label" for="title">Titulo:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Digite o Titulo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $name="";
                if(isset($valorForm['name'])) {
                $name=$valorForm['name'];} ?>
                <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="name" name="name" id="name" value="<?=$name;?>" placeholder="Digite o name" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $host="";
                if(isset($valorForm['host'])) {
                $host = $valorForm['host'];} ?>
                <label class="form-label" for="host">Host:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="host" id="host" value="<?php echo $host; ?>" placeholder="Digite o host" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $username="";
                if(isset($valorForm['username'])) {
                $username = $valorForm['username'];} ?>
                <label class="form-label" for="username">username:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Digite o username" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $password ="";
                if(isset($valorForm['password'])) {
                $password = $valorForm['password'];} ?>
                <label class="form-label" for="password">Senha:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="password" name="password" id="password" onkeyup="passwordStrength()" autocomplete="on" value="<?= $password; ?>" placeholder="Digite a Senha do E-mail" required>
                <span style="color:#f00;">* Campos obrigatórios</span><br>
                <span id="msgViewStrength"></span>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $smtpsecure="";
                if(isset($valorForm['smtpsecure'])) {
                $smtpsecure = $valorForm['smtpsecure'];} ?>
                <label class="form-label" for="smtpsecure">smtpsecure:</label>
                <input class="form-control" type="text" name="smtpsecure" id="smtpsecure" value="<?php echo $smtpsecure; ?>" placeholder="Digite o smtpsecure">
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $port=null;
                if(isset($valorForm['port'])) {
                $port = $valorForm['port'];} ?>
                <label class="form-label" for="port">port:</label>
                <input class="form-control" type="text" name="port" id="port" value="<?php echo $port; ?>" placeholder="Digite o port">
            </div>
            <div class="col-md-2 offset-5 mb-3">
                <button class="btn btn-primary" type="submit" name="SendAddEmailConfs" value="Cadastrar">Cadastrar</button>
            </div>
        </div>
    </div>
</form>



