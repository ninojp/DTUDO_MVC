<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }    
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Recuperar Senha</span>
        </div>
        <!-- Verifica se existir mensagem na $global[posição]: $_SESSION['msg'], exibe, depois destroi -->
        <?php if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); } ?>
        <!-- Local onde vai exibir a mensagem: $_SESSION['msg'] -->
        <span id="msg"></span>
        <form class="form-login" action="" method="POST" id="form-recover-pass">
            <div class="row">
            <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm)){echo $valorForm['email'];} ?>" placeholder="Digite o seu Email" required>
            </div>
            <div class="row  button">
                <button class="btn btn-primary" type="submit" name="SendRecoverPass" value="Recuperar">Recuperar</button>
            </div>
            <div class="signup-link text-center">
                <!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
                <a class="btn btn-sm btn-outline-info" href="<?=URLADM?>">Login</a>
            </div>
        </form>
    </div>
</div>


