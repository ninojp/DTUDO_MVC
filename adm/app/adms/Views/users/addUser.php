<?php
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<h1 class="text-center mt-5">Cadastrar Usuário</h1>
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<form action="" method="POST" id="form-add-user">
    <div class="row m-5">
        <div class="col-12 m-5">
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="name">Nome:</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>" placeholder="Digite o Email" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="user">Usuário:</label>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm['user'])){echo $valorForm['user'];} ?>" placeholder="Digite o usuário para acessar o administrativo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="password">Senha:</label>
                <input class="form-control" type="password" autocomplete="on" name="password" id="password" onkeyup="passwordStrength()" value="<?php if(isset($valorForm['password'])){echo $valorForm['password'];} ?>" placeholder="Digite a Senha do usuário" required><br>
                <span id="msgViewStrength"></span>
            </div>
            <div class="col-md-2 offset-5 mb-3">
                <button class="btn btn-primary" type="submit" name="SendAddUser" value="Cadastrar">Cadastrar</button>
            </div>
        </div>
    </div>
</form>
<!-- <div class="m-5"> -->
    <!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
    <a class="offset-md-6 btn btn-info" href="<?=URLADM?>">Clique aqui</a> Para acessar
<!-- </div> -->


