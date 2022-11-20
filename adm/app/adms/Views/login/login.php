<?php
        // echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
        
    if(isset($this->data['form'])){
        // var_dump($this->data['form']);
        $valorForm = $this->data['form'];
    }

    //Criptografar a senha
    // echo password_hash("123456a", PASSWORD_DEFAULT);
?>
<h1 class="text-center mt-5">Área Restrita</h1>
<form action="" method="POST">
    <div class="row m-5">
        <div class="col-5 m-5">
            <div class="mb-3">
                <label class="form-label" for="user">Usuário:</label>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm)){echo $valorForm['user'];} ?>" placeholder="Digite o nome do usuário">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Senha:</label>
                <input class="form-control" type="password" name="password" id="password" value="<?php if(isset($valorForm)){echo $valorForm['password'];} ?>" placeholder="Digite a Senha do usuário">
            </div>
            <div class="mb-3">
                <input type="submit" name="SendLogin" value="Acessar">
            </div>
        </div>
    </div>

</form>