<?php
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){
    // Redireciona para a pagina escolhida
    // header("Location: /");
    header("Location: https://localhost/dtudo/public/");
    // Ou termina a execução e exibe a mensagem de erro
    // die("Erro! Página não encontrada<br>");
}
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
//Criptografar a senha - Teste
// echo password_hash("123456a", PASSWORD_DEFAULT);
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>

<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Área Restrita</span>
        </div>
        <form class="form-login" action="" method="POST" id="form-login">
            <div class="row">
            <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm)){echo $valorForm['user'];} ?>" placeholder="Digite o E-mail cadastrado" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="password" autocomplete="on" id="password" value="<?php if(isset($valorForm)){echo $valorForm['password'];} ?>" placeholder="Digite a Senha do usuário" required><br>
                <!-- <span style="color:#f00;">* Campo obrigatório</span><br> -->
            </div>
                <!-- Verifica se existir mensagem na $global[posição]: $_SESSION['msg'], exibe, depois destroi -->
                <?php if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); } ?>
                <!-- Local onde vai exibir a mensagem: $_SESSION['msg'] do JavaScript-->
                <span id="msg"></span>
            <div class="row button">
                <button class="btn btn-primary" type="submit" name="SendLogin" value="Acessar">Acessar</button>
            </div>
            <div class="signup-link text-center">
                <!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
                <a class="btn btn-sm btn-outline-info me-4" href="<?=URLADM?>new-user/index">Cadastrar Usuário!</a>
                <a class="btn btn-sm btn-outline-info" href="<?=URLADM?>recover-password/index">Recuperar Senha!</a>
            </div>
        </form>
    </div><!-- Finalica a DIV:wrapper-login -->
</div><!-- Finalica a DIV:container-login -->

