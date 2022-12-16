<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<h1 class="text-center mt-5">Cadastrar Usuário</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-users/index'> Listar </a> ";
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<form action="" method="POST" id="form-add-user">
    <div class="row m-2">
        <div class="col-12 m-2">
            <div class="col-md-4 offset-md-4 mb-3">
            <?php $name="";
            if(isset($valorForm['name'])){
                $name = $valorForm['name'];} ?>
                <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
            <?php $email="";
            if(isset($valorForm['email'])) {
                $email=$valorForm['email'];} ?>
                <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="email" name="email" id="email" value="<?=$email;?>" placeholder="Digite o Email" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
            <?php $user="";
            if(isset($valorForm['user'])) {
                $user = $valorForm['user'];} ?>
                <label class="form-label" for="user">Usuário:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="user" id="user" value="<?php echo $user; ?>" placeholder="Digite o usuário para acessar o administrativo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="adms_sits_user_id">Situação:<span style="color:#f00;">*</span></label>
                <select name="adms_sits_user_id" id="adms_sits_user_id">
                    <option value="">Selecione</option>
                    <?php foreach($this->data['select']['sit'] as $sit){
                        extract($sit);
                        if((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)){
                            echo "<option value='$id_sit' selected>$name_sit</option>";
                        } else {
                            echo "<option value='$id_sit'>$name_sit</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
            <?php $password ="";
            if(isset($valorForm['password'])) {
                $password = $valorForm['password'];} ?>
                <label class="form-label" for="password">Senha:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="password" name="password" id="password" onkeyup="passwordStrength()" autocomplete="on" value="<?= $password; ?>" placeholder="Digite a Senha do usuário" required><br>
                <span id="msgViewStrength"></span>
                <span style="color:#f00;">* Campo obrigatório</span><br>
            </div>
            <div class="col-md-2 offset-5 mb-3">
                <button class="btn btn-primary" type="submit" name="SendAddUser" value="Cadastrar">Cadastrar</button>
            </div>
        </div>
    </div>
</form>



