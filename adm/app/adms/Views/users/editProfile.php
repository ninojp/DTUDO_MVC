<?php
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} 
// var_dump($this->data['form'][0]);
?>
<h1 class="text-center mt-5">Editar Perfil</h1>
<?php
// if(isset($valorForm['id'])){
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-users/index/".$valorForm['id']."'> Visualizar </a><br><hr>";
// }
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<form action="" method="POST" id="form-edit-profile">
    <div class="row m-5">
        <div class="col-12 m-5">
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="nickname">Apelido:</label>
                <input class="form-control" type="text" name="nickname" id="nickname" value="<?php if(isset($valorForm['nickname'])){echo $valorForm['nickname'];} ?>" placeholder="Digite um Apelido(nickname)">
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>" placeholder="Digite o Email" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="user">Usuário:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm['user'])){echo $valorForm['user'];} ?>" placeholder="Digite o usuário para acessar o administrativo" required>
            </div>
            <div class="col-md-4 offset-4 mb-3 text-center">
                <button class="btn btn-primary" type="submit" name="SendEditProfile" value="Salvar">Salvar</button><br>
                <span style="color:#f00;">* Campo obrigatório</span>
            </div>
        </div>
    </div>
</form>



