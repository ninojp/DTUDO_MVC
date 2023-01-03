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
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Novo Usuário</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div class="msg_alert" id='msg'></div>
        <form class="form_adms" action="" method="POST" id="form-add-user">
            <div class="row_input">
                <?php $name = "";
                if (isset($valorForm['name'])) {
                    $name = $valorForm['name'];
                } ?>
                <!-- <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o nome Completo  *">
            </div>
            <div class="row_input">
                <?php $email = "";
                if (isset($valorForm['email'])) {
                    $email = $valorForm['email'];
                } ?>
                <!-- <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?= $email; ?>" placeholder="Digite o Email *" required>
            </div>
            <div class="row_input">
                <?php $user = "";
                if (isset($valorForm['user'])) {
                    $user = $valorForm['user'];
                } ?>
                <!-- <label class="form-label" for="user">Usuário:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="user" id="user" value="<?php echo $user; ?>" placeholder="Digite o Usuário(login) *" required>
            </div>
            <div class="row_input">
                <?php $password = "";
                if (isset($valorForm['password'])) {
                    $password = $valorForm['password'];
                } ?>
                <!-- <label class="form-label" for="password">Senha:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="password" id="password" onkeyup="passwordStrength()" autocomplete="on" value="<?= $password; ?>" placeholder="Digite a Senha(login) do usuário *" required>
            </div>
            <div class="msg_alert_pass" id="msgViewStrength">
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="adms_sits_user_id">Selecione a Situação:<span style="color:#f00;">*</span></label>
                    <select name="adms_sits_user_id" id="adms_sits_user_id" required>
                        <option value="">Selecione</option>
                        <?php foreach ($this->data['select']['sit'] as $sit) {
                            extract($sit);
                            if ((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)) {
                                echo "<option value='$id_sit' selected>$name_sit</option>";
                            } else {
                                echo "<option value='$id_sit'>$name_sit</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="access_level_id">Nivel de Acesso:<span style="color:#f00;">*</span></label>
                    <select name="access_level_id" id="access_level_id" required>
                        <option value="">Selecione</option>
                        <?php foreach ($this->data['select']['lev'] as $lev) {
                            extract($lev);
                            if ((isset($valorForm['access_level_id'])) and ($valorForm['access_level_id'] == $id_lev)) {
                                echo "<option value='$id_lev' selected>$name_lev</option>";
                            } else {
                                echo "<option value='$id_lev'>$name_lev</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddUser" value="Cadastrar">Cadastrar Usuário</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-users/index"> Listar  Usuários </a>
            </div>
        </form>
    </div>
</div>