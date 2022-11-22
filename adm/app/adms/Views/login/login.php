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
                <label class="form-label" for="user">Usuário:</label>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm)){echo $valorForm['user'];} ?>" placeholder="Digite o usuário">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Senha:</label>
                <input class="form-control" type="password" name="password" id="password" value="<?php if(isset($valorForm)){echo $valorForm['password'];} ?>" placeholder="Digite a Senha do usuário">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="SendLogin" value="Acessar">Acessar</button>
            </div>
        </div>
    </div>
</form>
<div class="m-5">
<!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
    <a class="btn btn-info" href="<?=URLADM?>new-user/index">Cadastrar Usuário</a>
</div>

<br><br>
Usuário: cesar@celke.com.br<br>
Senha: 123456a<br>