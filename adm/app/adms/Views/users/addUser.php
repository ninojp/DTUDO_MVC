<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<!-- <h1 class="text-center mt-5">Cadastrar Usuário</h1> -->
<!-- <?php
        // echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-users/index'> Listar </a> ";
        // if(isset($_SESSION['msg'])){
        //     echo $_SESSION['msg'];
        //     unset($_SESSION['msg']);
        // } 
        ?>
<span id="msg"></span> -->
<div class="container-adms">
    <div class="wrapper-adms">
        <div class="title">
            <span>Cadastrar Novo Usuário</span>
        </div>
        <div class="msg-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
        </div>
        <div class="msg-alert">
            <span id="msg"></span>
        </div>
        <form class="form-adms" action="" method="POST" id="form-add-user">
            <div class="row">
                <?php $name = "";
                if (isset($valorForm['name'])) {
                    $name = $valorForm['name'];
                } ?>
                <!-- <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o nome Completo  *" required>
            </div>
            <div class="row">
                <?php $email = "";
                if (isset($valorForm['email'])) {
                    $email = $valorForm['email'];
                } ?>
                <!-- <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?= $email; ?>" placeholder="Digite o Email  *" required>
            </div>
            <div class="row">
                <?php $user = "";
                if (isset($valorForm['user'])) {
                    $user = $valorForm['user'];
                } ?>
                <!-- <label class="form-label" for="user">Usuário:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="user" id="user" value="<?php echo $user; ?>" placeholder="Digite o Usuário  *" required>
            </div>
            <div class="row">
                <?php $password = "";
                if (isset($valorForm['password'])) {
                    $password = $valorForm['password'];
                } ?>
                <!-- <label class="form-label" for="password">Senha:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="password" id="password" onkeyup="passwordStrength()" autocomplete="on" value="<?= $password; ?>" placeholder="Digite a Senha do usuário  *" required><br>
            </div>
            <div class="msg-alert" id="msgViewStrength">
                <!-- <span ></span> -->
            </div>
            <div class="col mt-2">
                <label class="form-label" for="adms_sits_user_id">Selecione uma Situação:<span style="color:#f00;">*</span></label>
                <select name="adms_sits_user_id" id="adms_sits_user_id">
                    <option value="">Selecione</option>
                    <?php foreach ($this->data['select']['sit'] as $sit) {
                        extract($sit);
                        if ((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)) {
                            echo "<option value='$id_sit' selected>$name_sit</option>";
                        } else {
                            echo "<option value='$id_sit'>$name_sit</option>";
                        }
                    } ?>
                </select>
                <br><span style="color:#f00;">* Campos obrigatórios</span><br>
            </div>
            <div class="button text-center mt-3">
                <button class="btn btn-primary" type="submit" name="SendAddUser" value="Cadastrar">Cadastrar</button>
            </div>
            <div class="signup-link text-center mt-3">
                <?= "<a class='btn btn-sm btn-outline-info' href='".URLADM."list-users/index'> Listar </a>"; ?>
            </div>
        </form>
    </div>
</div>