<?php
        // echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
        
    if(isset($this->data['form'])){
        // var_dump($this->data['form']);
        $valorForm = $this->data['form'];
    }
    //Criptografar a senha
    // echo password_hash("123456a", PASSWORD_DEFAULT);
?>
<h1 class="text-center mt-5">Fazer o Login</h1>
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<span id="msg"></span>
<form action="" method="POST" id="form-login">
    <div class="row m-5">
        <div class="col-5 m-5">
            <div class="mb-3">
                <label class="form-label" for="user">Usuário:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm)){echo $valorForm['user'];} ?>" placeholder="Digite o usuário" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Senha:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="password" name="password" autocomplete="on" id="password" value="<?php if(isset($valorForm)){echo $valorForm['password'];} ?>" placeholder="Digite a Senha do usuário" required><br>
                <span style="color:#f00;">* Campo obrigatório</span><br>
            </div>
            <div class="mb-4">
                <button class="btn btn-primary" type="submit" name="SendLogin" value="Acessar">Acessar</button>
            </div>
        </div>
    </div>
</form>
<div class="m-3">
<!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
    <a class="btn btn-info me-3" href="<?=URLADM?>new-user/index">Cadastrar Usuário</a>
    <a class="btn btn-outline-primary" href="<?=URLADM?>recover-password/index">Recuperar Senha!</a>
</div>
<br>
Usuário: cesar@celke.com.br<br>
Senha: 123456a<br>